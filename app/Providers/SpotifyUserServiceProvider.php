<?php

namespace App\Providers;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Libraries\Spotify\SpotifyWebAPI;

class SpotifyUserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('spotifyUserWebAPI', function ($app) {

            $tokenIsReady = false;
            //$rateLimitExceeded = false;
            $attempts = 0;
            $maxAttempts = 5;
            do {
                if($user){
                    //$user = Auth::user();
                    // Tokens last an hour so this gives us 10 minutes 
                    // to do whatever we need to.
                    if($user->expires_at < Carbon::now()->addMinutes(50)){
                        $accessToken = Auth::user()->access_token;
                    }else{
                        // Request new Access token
                    }
                    
                    $tokenIsReady = true;
                }else{
                    // Use isnt logged in so redirect to log in
                    return redirect('/');
                }
            } while($tokenIsReady === false);

            // Once token is in cache we can continue and set it 
            $client = new SpotifyWebAPI($accessToken);

            //$client->setAccessToken($accessToken);

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
