<?php

namespace App\Libraries\Spotify;

use App\Libraries\APIRequest;
use App\Libraries\Spotify\SpotifyRequestInterface;
use \App\Libraries\Spotify\Session;

class SpotifyWebAPI
{
    //const API_URL = 'https://api.spotify.com/v1';

    protected $accessToken = null;
    protected $refreshToken = null;
    protected $expiresIn = null;

    protected $session;
    
    protected $userScopes = [
        'user-read-email',
        'user-library-read',
        'user-library-modify',
        'playlist-modify-public',
        'playlist-modify-private'
    ];

    /**
     * Constructor
     * Set up Request object.
     *
     * @param Request $request Optional. The Request object to use.
     */
    public function __construct($token)
    {
        $provider = new SpotifyRequestInterface($token);
        $this->request = new APIRequest($provider);
        $this->session = new Session();
    }


    protected function authHeaders()
    {
        $headers = [];

        if ($this->accessToken) {
            $headers['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        return $headers;
    }

    public function authUrl()
    {
        $authUrl = $this->session->getAuthorizeUrl(
            ['scope' => $this->userScopes]
        );

        return $authUrl;
    }

    public function requestUserToken($code)
    {
        $tokens = $this->session->requestAccessToken($code);
        
        $this->accessToken = $tokens->access_token;
        $this->refreshToken = $tokens->refresh_token;
        $this->expiresIn = $tokens->expires_in;

        return $tokens;
    }

    public function requestNewUserToken($user)
    {
        $tokens = $this->session->requestNewAccessToken($user->refresh_token);
        
        $this->accessToken = $tokens->access_token;
        $this->refreshToken = $tokens->refresh_token;
        $this->expiresIn = $tokens->expires_in;

        return $tokens;
    }


    public function me()
    {
        $headers = $this->authHeaders();

        $uri = '/me';

        return $this->request->api('GET', $uri, [], $headers);

        //return $this->lastResponse['body'];
    }


    public function getMySavedAlbums($options = [])
    {
        $headers = $this->authHeaders();

        $uri = '/me/albums';

        return $this->request->api('GET', $uri, $options, $headers);
    }

    public function getArtist($artistId)
    {

        $uri = '/artists/' . $artistId;

        return $this->request->api('GET', $uri, []);
    }

    
    public function getUserPlaylist($userId, $playlistId, $options = [])
    {
        $options = (array) $options;

        if (isset($options['fields'])) {
            $options['fields'] = implode(',', (array) $options['fields']);
        }


        $uri = '/users/' . $userId . '/playlists/' . $playlistId;

        return $this->request->api('GET', $uri, $options);
    }


    public function search($query, $type, $options = [])
    {
        $type = implode(',', (array) $type);
        $options = array_merge((array) $options, [
            'q' => $query,
            'type' => $type,
        ]);


        $uri = '/search';

        return $this->request->api('GET', $uri, $options);
    }

}