<?php

namespace App\Jobs;

use App\Libraries\Spotify\SpotifyWebAPI;
use Artisan;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddReleaseToUserAccountsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fan;
    protected $spotify_release_id;
    protected $spotify;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Fan $fan, $spotify_release_id)
    {
        $this->fan = $fan;
        $this->spotify_release_id = $spotify_release_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Artisan::call('fan:refreshToken', ['fan' => $this->fan->id]);

        $this->spotify = new SpotifyWebAPI($this->fan->access_token);

        $this->spotify->addMyAlbums([$this->spotify_release_id]);
    }
}
