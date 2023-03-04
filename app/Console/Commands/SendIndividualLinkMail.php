<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use App\Http\Controllers\CronController;

class SendIndividualLinkMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:individual';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to individual recipients.';

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
     * @return int
     */
    public function handle()
    {
        $ob = new \App\Http\Controllers\CronController();
        $ob->sendIndividualCampaignRedeemLinkEmail();

       // \Log::error('staging :: individual cron job command..');
        // \Log::channel('cronLog')->info('staging :: individual cron job command..');
        return 0;
    }
}
