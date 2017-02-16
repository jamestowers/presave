<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use SpotifyWebAPI;
use Cache;

class SpotifyUserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('spotifyUserWebAPI', function ($app) {


            $tokenIsReady = false;
            $attempts = 0;
            $maxAttempts = 5;
            do {
                if(Cache::has('spotify_access_token')){
                    $accessToken = Cache::get('spotify_access_token');
                    $tokenIsReady = true;
                }else{
                    // Refresh token and cache it
                    \Illuminate\Support\Facades\Artisan::call('spotify:refreshToken');
                    // If that fails try it again up to $maxAttempts times.
                    $attempts++;
                    if($attempts === $maxAttempts){
                        abort(500, 'Could not refresh Spotify access token');
                    }
                }
            } while($tokenIsReady === false);

            // Once token is in cache we can continue and set it 
            $client = new SpotifyWebApi\SpotifyWebApi;

            $client->setAccessToken($accessToken);

            return $client;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['spotifyUserWebAPI'];
    }

}
