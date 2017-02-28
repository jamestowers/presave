<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

//use Concat\Http\Middleware\RateLimiter;
//use App\Libraries\APIRequestRateLimiter;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

class APIRequest
{
    protected $provider = null;

    protected $client = null;

    protected $lastResponse = null;


    
    /**
     * Set up the Guzzle client with necessary middleware
     * @param RequestInterface $provider [description]
     */
    public function __construct(APIRequestInterface $provider)
    {
        $this->provider = $provider;

        $handlerStack = HandlerStack::create( new CurlHandler() );
        $handlerStack->push( Middleware::retry( $this->retryDecider(), $this->retryDelay() ) );

        /**
         * If RequestInterface has a $maxRequestesPerMinute
         * then use the rate limiter
         */
        /*if($this->provider->getMaxRequestsPerMinute()){
            $rateLimitProvider = new APIRequestRateLimiter($this->provider->getMaxRequestsPerMinute());
            $handlerStack->push(new RateLimiter($rateLimitProvider));
        }*/

        $this->client = new Client( ['handler' => $handlerStack] );
    }


    /**
     * [api description]
     * @param  str     Request method (GET, POST, etc.)
     * @param  str     Endpoint Url to call
     * @param  array   Query params to send with request
     * @return obj     Object
     */
    public function api($method, $uri, $parameters = [])
    {   

        $method = strtoupper($method);

        $options = $this->getOptions($method, $parameters);

        $options['headers'] = $this->provider->authHeaders();
        \Log::info($options);
        //dd($options);
        $response = $this->client->request($method, $this->provider->baseUrl . $uri, $options);

        //$response->getHeader('Content-Type');
        $status = $response->getStatusCode();
        $headers = $response->getHeaders();
        $body = $this->provider->parseBody($response);
        
        $this->lastResponse = [
            'headers' => $headers,
            'status' => $status,
            'url' => $uri,
        ];

        if ($status >= 200 && $status <= 299) {
            $this->lastResponse['body'] = $body;
            
            return $this->lastResponse['body'];
        }
        
    }


    /**
     * Generate the request parameters based on reqest method
     * @param  str   $method      Request method (GET, POST etc.)
     * @param  array $parameters  Array of parameters to send wth request
     * @return array 
     */
    private function getOptions($method, $parameters)
    {
        //$authHeaders = $this->authHeaders();
        $query = null;
        $formParams = null;
        $body = null;

        switch ($method) {
            case 'DELETE': // No break
            case 'PUT':
            case 'POST':
                if (is_array($parameters) || is_object($parameters)) {
                    $formParams = $parameters;
                }
                else {
                    $body = $parameters;
                }
                break;
            default:
                $query = $parameters;
                break;
        }

        return [
            'query' => $query,
            'form_params' => $formParams,
            'body' => $body
        ];
    }


    private function retryDecider(){
        return function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            // Limit the number of retries to 5
            if ($retries >= 5) {
                return false;
            }
            // Retry connection exceptions
            if ($exception instanceof ConnectException) {
                return true;
            }
            if ($response) {
                // Retry on server errors
                if ($response->getStatusCode() >= 500) {
                    return $this->provider->handle500Error($response);
                }
                if ($response->getStatusCode() == 401) {
                    // Must return true or false
                    return $this->provider->handle401Error($response);
                }
                /*if ($response->getStatusCode() == 404) {
                    // Must return true or false
                    return $this->provider->handle404Error($response);
                }*/
                // Retry on rate limits
                if ($response->getStatusCode() == 429) {
                    return $this->provider->handle429Error($response);
                }
            }
            return false;
        };
    }


    private function retryDelay() {
        return function( $numberOfRetries ) {
            return 1000 * $numberOfRetries;
        };
    }
}