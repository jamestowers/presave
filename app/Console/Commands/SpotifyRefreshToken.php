<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\Spotify\Session;
use Cache;

class SpotifyRefreshToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spotify:refreshToken';
    /*protected $scopes = [
        'playlist-read-private',
        'user-read-private',
    ]*/

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extend and cache the Spotify access token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->session = new Session(
            /*config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')*/
        );
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    
        $token = $this->session->getClientCredentialsToken();

        if($token){
            Cache::put('spotify_access_token', $token->access_token, $token->expires_in); // Spotify token lasts 1 hour
            \Illuminate\Support\Facades\Artisan::call('queue:restart');
        }
        else{
            throw new \App\Spotify\SpotifyWebAPIException("Could not refresh Spotify access token", 500);
        }
    }
}
