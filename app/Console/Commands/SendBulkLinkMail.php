<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendBulkLinkMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:bulk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to bulk recipients';

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
        $ob->sendBulkCampaignRedeemLinkEmail();

        // \Log::error('staging :: bulk cron job command..');
        // \Log::channel('cronLog')->info('staging :: bulk cron job command..');
        return 0;
    }
}
