<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\AddReleaseToUserAccountsJob;

use Illuminate\Foundation\Bus\DispatchesJobs;

class AddReleasesToUserAccounts extends Command
{

    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fans:addReleases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add any pending releases to user account';

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
    public function handle(\App\Campaign $campaigns)
    {
        $now = \Carbon\Carbon::now();
        $pendingCampaigns = $campaigns
            ->where('release_date', '<', $now)
            ->whereNotNull('release_spotify_id')
            ->whereStatus('pending')
            ->get();

        foreach($pendingCampaigns as $campaign){
            $processedCount = 0;
            $fanCount = $campaign->fans->count();
            foreach($campaign->fans as $fan){
                $this->dispatch(new AddReleaseToUserAccountsJob($fan, $campaign->release_spotify_id));
                $processedCount++;
                if($processedCount === $fanCount){
                    $campaign->status = 'complete';
                    $campaign->save();
                }
            }
        };

    }
}
