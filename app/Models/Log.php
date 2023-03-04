<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipient;
use App\Models\User;
//use App\Models\Campaign;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_user_id', 'recipient_id', 'redeem_link', 'status', 'medium', 'description', 'created_at', 'campaign_id'
    ];

    public function clientInfo()
    {
        return $this->belongsTo('App\Models\User', 'client_user_id', 'id');
    }

    public function recipientInfo()
    {
        return $this->belongsTo('App\Models\Recipient', 'recipient_id', 'id');
    }

    // // Get campaign name
    public function campaignInfo()
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign_id', 'id');
    }

    public static function saveLog($data)
    {
        $log = new Log();
        $log->client_user_id = !empty($data['client_user_id']) ? $data['client_user_id'] : NULL;
        $log->recipient_id = !empty($data['recipient_id']) ? $data['recipient_id'] : NULL;
        $log->redeem_link = !empty($data['redeem_link']) ?
            $data['redeem_link'] : NULL;
        $log->status = true;
        $log->medium = !empty($data['medium']) ? $data['medium'] : NULL;
        $log->description = !empty($data['description']) ? $data['description'] : NULL;
        $log->campaign_id = !empty($data['campaign_id']) ? $data['campaign_id'] : NULL;
        $log->email_subject = !empty($data['subject']) ? $data['subject'] : NULL;
        $log->save();
    }

    public static function getAllLog($page = null)
    {
        if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
            $clientId = \Auth::guard(getAuthGaurd())->user()->id;
            $data = Log::with('recipientInfo.recipientGroups', 'campaignInfo')->where(['client_user_id' => $clientId]);
        } else {
            $data = Log::with('recipientInfo.recipientGroups', 'campaignInfo', 'clientInfo.client');
        }


        if ($page == true) {
            return $data->orderBy('id', 'DESC');
        } else {
            return $data->orderBy('id', 'DESC')->get();
        }
    }


    public static function getLogByEmailSubject($data)
    {
        \Log::info("Inside Log Model =================>");
        \Log::info($data);
        $log =  Log::where('email_subject', $data['subject'])
            ->where('recipient_id', $data['rec_id'])
            ->orderBy('id', 'DESC')
            ->first();

        if (!empty($log)) {
            $log->open_count = $data['open_count'];
            $log->link_count = $data['link_count'];
            $log->save();
        }

        return;
    }
}
