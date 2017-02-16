<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cache;

class SpotifyRefreshToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spotify:refreshToken';
    protected $scopes = [];

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
        $this->session = new \SpotifyWebAPI\Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
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
        
        $this->session->requestCredentialsToken($this->scopes);

        $token = $this->session->getAccessToken();

        if($token){
            $expiresAt = \Carbon\Carbon::now()->addMinutes(58);
            Cache::put('spotify_access_token', $token, $expiresAt); // Spotify token lasts 1 hour
            \Illuminate\Support\Facades\Artisan::call('queue:restart');
        }
        else{
            throw new \SpotifyWebAPI\SpotifyWebAPIException("Could not refresh Spotify access token", 500);
        }
    }
}
