<?php

namespace App\Console\Commands;

use App\Libraries\Spotify\SpotifyWebAPI;

use Illuminate\Console\Command;

class RefreshFanAccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fan:refreshToken {fan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh a fan\'s access token';


    protected $fan;
    protected $spotify;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(\App\Fan $fanModel)
    {
        $fanId = $this->argument('fan');

        $fan = $fanModel->find($fanId);

        $spotify = new SpotifyWebAPI();

        $tokens = $spotify->requestNewUserToken($fan);
        $fan->access_token = $tokens->access_token;
        $fan->expires_at = \Carbon\Carbon::now()->addSeconds($tokens->expires_in);
        
        $fan->save();
    }
}
