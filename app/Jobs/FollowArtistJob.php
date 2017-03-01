<?php

namespace App\Jobs;

use App\Fan;
use App\Artist;
use App\Libraries\Spotify\SpotifyWebAPI;
use Artisan;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FollowArtistJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fan;

    protected $artist;

    protected $spotify;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Fan $fan, Artist $artist)
    {
        $this->fan = $fan;
        $this->artist = $artist;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->fan->expires_at < \Carbon\Carbon::now()->subSeconds(60)){
            Artisan::call('fan:refreshToken', ['fan' => $this->fan->id]);
        }
        $this->spotify = new SpotifyWebAPI($this->fan->access_token);

        $this->spotify->followArtists([$this->artist->spotify_id]);
    }
}
