<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    use HasFactory;

    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function campaignInfo()
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign_id', 'id');
    }

    public static function saveNotification($data)
    {

        $notification = new Notification;

        $notification->from_id = $data['user_id'];
        $notification->to_id = isset($data['to_id']) ? $data['to_id'] : 0;
        $notification->title = isset($data['title']) ? $data['title'] : 'NA';
        $notification->campaign_id = isset($data['campaign_id']) ? $data['campaign_id'] : null;
        $notification->description = isset($data['description']) ? $data['description'] : 'NA';
        $notification->type = isset($data['type']) ? $data['type'] : 'NA';
        $notification->company_id = isset($data['company_id']) ? $data['company_id'] : 'NA';

        $notification->save();
        
        \Log::info($notification);

        return;
    }
}
