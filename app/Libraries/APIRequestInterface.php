<?php 

namespace App\Libraries;

use GuzzleHttp\Psr7\Response;

interface APIRequestInterface
{

    /**
     * Get API base url
     * @var [string]
     */
    public function getBaseUrl();

    /**
     * Get the API's rate limit
     * @return int or false
     */
    public function getMaxRequestsPerMinute();

    /**
     * Add authorization headers.
     *
     * @return array Authorization headers.
     */
    public function authHeaders();

    /**
     * Handle 401 error and return true or false RetryDecider
     * True = should retry request
     * @return [boolean] [description]
     */
    public function handle401Error(Response $response);

    /**
     * Handle 500 error and return true or false RetryDecider
     * True = should retry request
     * @return [boolean] [description]
     */
    public function handle500Error(Response $response);

    /**
     * Handle 429 error and return true or false RetryDecider
     * True = should retry request
     * @return [boolean] [description]
     */
    public function handle429Error(Response $response);


    /**
     * Return the respnse error message
     * @param  Response object
     * @return [string]
     */
    public function getErrorMessage(Response $response);
}