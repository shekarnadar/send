<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sendnotification to the recipient';

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
        $ob->sendReadmeNotification();

       // \Log::error('staging :: individual cron job command..');
       // \Log::channel('cronLog')->info('staging :: send notification cron job command..');

        return 0;
    }
}
