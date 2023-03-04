<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    use HasFactory;

    protected $table='cron_logs';

    public static function saveCronLog($data)
    {
        $cron_log = new CronLog;

        $cron_log->cron_type = $data['cron_type'];
        $cron_log->campaign_id = $data['campaign_id'];
        $cron_log->is_crone_executed = $data['is_crone_executed'];
        $cron_log->status = $data['status'];

        $cron_log->save();

        return;
    }
}
