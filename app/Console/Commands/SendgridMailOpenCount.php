<?php

namespace App\Console\Commands;

use App\Models\Log;
use App\Models\Recipient;
use Illuminate\Console\Command;

class SendgridMailOpenCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendgrid:opencount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update mail open count using SendGrid Message API';

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
        $data = sendGridMessageFilter();
\Log::info($data);
        foreach ($data as $value) {
            $new_data['rec_id'] = Recipient::getIdByEmail($value['to_email']);
            $new_data['subject'] = $value['subject'];

            $new_data['open_count'] = $value['opens_count'];
            $new_data['link_count'] = $value['link_count'];
            Log::getLogByEmailSubject($new_data);
        }
    }
}
