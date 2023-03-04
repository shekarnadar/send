<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PickrrOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pickrr:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pickrr order staus change';

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
        $ob->orderStatusChangeIfDelivered();

        //\Log::error('staging :: order deliver cron job command..');
        \Log::channel('cronLog')->info('staging :: order deliver cron job command..');
        return 0;
    }
}
