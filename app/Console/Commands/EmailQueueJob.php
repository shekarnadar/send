<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailQueueJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:queuejob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run email queue';

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
        \Artisan::call('queue:work');
       // \Log::error(':::::::::::::: email queue start ::::::::::::');
        \Log::channel('cronLog')->info(':::::::::::::: email queue start ::::::::::::');
        return 0;
    }
}
