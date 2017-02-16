<?php

namespace App\Jobs;

use App\User;
use App\Libraries\SpotifyAPI;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddAlbumToUserAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $albumIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $albumIds)
    {
        $this->user = $user;
        $this->albumIds = $albumIds;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->spotify->setToken($this->user->access_token);

        foreach($this->albumIds as $id){
            if(!$this->spotify->api->addMyAlbums($id)){
                abort(400, 'Error adding album ' . $id);
            }
        }
    }
}
