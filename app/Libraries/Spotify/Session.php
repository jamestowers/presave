<?php
namespace  App\Libraries\Spotify;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Session
{
    protected $client;
    protected $clientId = '';
    protected $clientSecret = '';
    protected $redirectUri = '';
    protected $accessToken = '';
    protected $refreshToken;
    protected $expirationTime = 0;

    const ACCOUNT_URL = 'https://accounts.spotify.com';

    /**
     * Constructor
     * Set up client credentials.
     *
     * @param string $clientId The client ID.
     * @param string $clientSecret The client secret.
     * @param string $redirectUri Optional. The redirect URI.
     */
    public function __construct()
    {
        $this->clientId = config('services.spotify.client_id');
        $this->clientSecret = config('services.spotify.client_secret');
        $this->redirectUri = config('services.spotify.redirect');

        $this->client = new Client(['headers' => $this->getHeaders()]);
        
    }


    protected function getHeaders()
    {
        $payload = base64_encode($this->clientId . ':' . $this->clientSecret);
        $headers = [
            'Authorization' => 'Basic ' . $payload
        ];

        return $headers;
    }

    protected function parseResponse($response)
    {
        $body = $response->getBody();
        $result = json_decode($body->getContents());

        return $result;
    }



    /**
     * Get the authorization URL.
     *
     * @param array|object $options Optional. Options for the authorization URL.
     * - array scope Optional. Scope(s) to request from the user.
     * - boolean show_dialog Optional. Whether or not to force the user to always approve the app. Default is false.
     * - string state Optional. A CSRF token.
     *
     * @return string The authorization URL.
     */
    public function getAuthorizeUrl($options = [])
    {
        $options = (array) $options;

        $parameters = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => isset($options['scope']) ? implode(' ', $options['scope']) : null,
            'show_dialog' => !empty($options['show_dialog']) ? 'true' : null,
            'state' => isset($options['state']) ? $options['state'] : null,
        ];

        return self::ACCOUNT_URL . '/authorize/?' . http_build_query($parameters);
    }



    /**
     * Request an access token using the Client Credentials Flow.
     *
     * @param array $scope Optional. Scope(s) to request from the user.
     *
     * @return bool True when an access token was successfully granted, false otherwise.
     */
    public function getClientCredentialsToken($scope = [])
    {
        /*$headers = $this->getHeaders();

        $client = new Client(['headers' => $headers]);*/
        $response = $this->client->request('POST', self::ACCOUNT_URL . '/api/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'scope' => isset($scope) ? implode(' ', $scope) : null
            ]
        ]);

        $result = $this->parseResponse($response);
        
        if (isset($result->access_token)) {
            //$this->expirationTime = time() + $token->expires_in;
            return $result;
        }

        return false;
    }

    /**
     * Request an access token given an authorization code.
     *
     * @param string $authorizationCode The authorization code from Spotify.
     *
     * @return bool True when the access token was successfully granted, false otherwise.
     */
    public function requestAccessToken($authorizationCode)
    {
        /*$headers = $this->getHeaders();

        $client = new Client(['headers' => $headers]);*/
        $response = $this->client->request('POST', self::ACCOUNT_URL . '/api/token', [
            'form_params' => [
                'code' => $authorizationCode,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUri
            ]
        ]);

        $result = $this->parseResponse($response);

        if (isset($result->refresh_token) && isset($result->access_token)) {
            $this->refreshToken = $result->refresh_token;
            $this->accessToken = $result->access_token;
            $this->expirationTime = time() + $result->expires_in;

            return $result;
        }

        return false;
    }


    public function requestNewAccessToken($refreshToken)
    {
        /*$headers = $this->getHeaders();

        $client = new Client(['headers' => $headers]);*/
        $response = $this->client->request('POST', self::ACCOUNT_URL . '/api/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken
            ]
        ]);

        $result = $this->parseResponse($response);

        if (isset($result->access_token)) {
            $this->accessToken = $result->access_token;
            $this->expirationTime = time() + $result->expires_in;

            return $result;
        }

        return false;
    }

    
}
