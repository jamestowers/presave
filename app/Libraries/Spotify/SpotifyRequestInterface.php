<?php

namespace App\Libraries\Spotify;

use GuzzleHttp\Psr7\Response;
use App\Libraries\APIRequestInterface;

class SpotifyRequestInterface implements APIRequestInterface
{
    public $baseUrl = 'https://api.spotify.com/v1';

    public $maxRequestesPerMinute = false;

    protected $accessToken = null;


    public function __construct($token)
    {
        $this->accessToken = $token;
    }


    /**
     * Get API base url
     * @var [string]
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    } 

    public function getMaxRequestsPerMinute()
    {
        return $this->maxRequestesPerMinute;
    } 


    /**
     * Add authorization headers.
     *
     * @return array Authorization headers.
     */
    public function authHeaders()
    {
        $headers = [];

        if ($this->accessToken) {
            $headers['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        return $headers;
    }

    public function parseBody(Response $response)
    {
        $rawBody = $response->getBody()->getContents();
        return json_decode($rawBody);
    }

    /**
     * Handle 401 error and return true or false RetryDecider
     * True = should retry request
     * @return [boolean] [description]
     */
    public function handle401Error(Response $response)
    {
        // TODO: handle 401 errors that aren't token related 
        \Log::info($this->getErrorMessage($response) . "\n");
        
        \Illuminate\Support\Facades\Artisan::call('spotify:refreshToken');
        return true;
    }

    /**
     * Handle 500 error and return true or false RetryDecider
     * True = should retry request
     * @return [boolean] [description]
     */
    public function handle429Error(Response $response)
    {
        $retryDelay = $response->getHeaderLine('Retry-After');
        if (strlen($retryDelay)) {
            printf(" retry delay: %d secs\n", (int)$retryDelay);
            sleep((int)$retryDelay);
            return true;
        }
    }

    /**
     * Handle 429 error and return true or false RetryDecider
     * True = should retry request
     * @return [boolean] [description]
     */
    public function handle500Error(Response $response)
    {
        //
    }

    /**
     * Return the respnse error message
     * @param  Response object
     * @return [string]
     */
    public function getErrorMessage(Response $response)
    {
        $rawBody = (string) $response->getBody();
        return json_decode($rawBody)->error->message;
    }
}