<?php

namespace App\Libraries;

use SpotifyWebAPI;

class SpotifyAPI
{

    public $session;

    public $api;

    protected $accessToken = null;

    protected $scopes = [
        'user-read-email',
        'user-library-read',
        'user-library-modify',
        'playlist-modify-public',
        'playlist-modify-private'
    ];

    protected $adminScopes = [];
    
    public function __construct()
    {
        $this->session = new SpotifyWebAPI\Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
        );

        $this->api = new SpotifyWebApi\SpotifyWebApi;

    }

    public function api()
    {
        
    }

    public function authUrl()
    {
        $authUrl = $this->session->getAuthorizeUrl(
            [
                'scope' => $this->scopes
            ]
        );

        return $authUrl;
    }

    /*public function requestAdminToken()
    {
        $this->session->requestCredentialsToken($this->adminScopes);
        $accessToken = $session->getAccessToken();
        $this->api->setAccessToken($accessToken);
    }*/

    public function requestToken($code)
    {
        $this->session->requestAccessToken($code);
        $accessToken = $this->session->getAccessToken();
        $refreshToken = $this->session->getRefreshToken();

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ];
    }

    public function setToken($token)
    {
        $this->api->setAccessToken($token);
    }
    
}