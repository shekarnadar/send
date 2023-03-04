<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipient;
use App\Models\Client;
use App\Models\RecipientGroupMapping;
use App\Models\Campaign;
use App\Models\Log;
use Illuminate\Support\Facades\DB;


class CampaignRecipient extends Model
{
    use HasFactory;

    public function recipient(){
        return $this->belongsTo('App\Models\Recipient', 'recipient_id','id');
    }

    public function recipientProductRedeemDetail(){
        return $this->hasOne('App\Models\RecipientProductRedeemDetail', 'campaign_recipient_id','id');
    }
    public function campaign(){
        return $this->belongsTo('App\Models\Campaign', 'campaign_id','id');
    }

    public function recipientGroupMapping(){
        return $this->hasMany('App\Models\RecipientGroupMapping', 'recipient_id');
    }

    public function recipientGroups(){
        return $this->belongsToMany('App\Models\RecipientGroup', 'recipient_group_mapping','recipient_id','group_id');
    }

    public function recipientProductRedeem(){
        return $this->hasMany('App\Models\RecipientProductRedeem','campaign_recipient_id');
    }

    public function logInfo(){
        return $this->belongsTo('App\Models\Log', 'recipient_id','recipient_id');
    }
    public static function updateRecipent($request,$array_diff){
        $recipientIds =explode(',',$request['recipient_id']);
        if($request['campgroup_id'] != $request['group_id']){
            
           CampaignRecipient::where('campaign_id',$request['campaign_id'])->delete();

            $camp_update['group_id'] = $request['group_id'];
        }
        
        if($request['recipient_type'] == 'grouplist'){
            $recps = RecipientGroupMapping::where('group_id', $request['group_id'])
                   ->whereHas('recipient', function($q){ 
                        return $q->where('is_active',1);
                    })->get()->pluck(['recipient_id']);
            $recipientIds = $recps->toArray();
        }
        $camp_update['budget'] = count($recipientIds)  * $request['max_price'];

        Campaign::where('id',$request['campaign_id'])->update($camp_update);

        if(count($recipientIds) > 0){
                 foreach($recipientIds as $id){
                    //Now check avilable in campagian
                     $check = CampaignRecipient::where('campaign_id',$request['campaign_id'])->where('recipient_id',$id)->first();

                    if(empty($check)){
                        $recep = Recipient::where('id', $id)->first();
                        $uuid = \Str::uuid()->toString();
                        $redeemLink = 'redeem/'.$uuid;
                        $urlkey = genrateShortLink(url($redeemLink));
                        $camp = new CampaignRecipient();
                        $camp->recipient_id = $id;
                        $camp->campaign_id = $request['campaign_id'];
                        $camp->redeem_link = $redeemLink;
                        $camp->urlkey = $urlkey;
                        $camp->save();
                    }
                 }
            }
         if(!empty($array_diff)){
            foreach($array_diff as $value){
                 CampaignRecipient::where('campaign_id',$request['campaign_id'])->where('recipient_id',$value)->delete();
            }
         }
        
       
    }
    public static function saveCampaignRecipient($post){
        $client = Client::getDetailById(\Auth::guard(getAuthGaurd())->user()->client_id);

        $recipientIds = explode(',', $post['recipient_id']);
        
        if($post['recipient_type'] == 'grouplist'){
           $recps = RecipientGroupMapping::where('group_id', $post['group_id'])
                   ->whereHas('recipient', function($q){ 
                        return $q->where('is_active',1);
                    })->get()->pluck(['recipient_id']);

           $recipientIds = $recps->toArray();
        }

        if(count($recipientIds) > 0){
            foreach($recipientIds as $id){
                $uuid = \Str::uuid()->toString();
                $redeemLink = 'redeem/'.$uuid;
                $urlkey = genrateShortLink(url($redeemLink));
                $camp = new CampaignRecipient();
                $camp->recipient_id = $id;
                $camp->campaign_id = $post['campaign_id'];
                $camp->redeem_link = $redeemLink;
                $camp->urlkey = $urlkey;
                $camp->is_egift_campaign = $post['is_egift'];
                $camp->egift_price = $post['egift_price'];
                $camp->save();
            }
        }
    }

    public static function getDetailsByRedeemLink($link){
        return self::where('redeem_link', "redeem/$link")->first();
    }

    public static function campaignRecipientsList($post) {
        return CampaignRecipient::with('logInfo')->where('campaign_id',$post['id'])->orderBy('id', 'DESC')->get();
    }

    public static function recipientDetails($campaign_id){
        $campaign = campaignRecipient::where('id',$campaign_id)->first();
        return $campaign;
    }

    // public static function campaignRecipientsList($post) {
    //     return CampaignRecipient::with('logInfo')->where('campaign_id',$post['id'])->orderBy('id', 'DESC')->get();
    // }
    public static function campaignRecipient(){
		$userId = \Auth::guard(getAuthGaurd())->user()->id;
        $data = CampaignRecipient::select("campaign_recipients.campaign_id", "campaign_recipients.recipient_id","campaigns.*","recipients.first_name","recipients.last_name")
        ->join("campaigns","campaigns.id","=","campaign_recipients.campaign_id")
        ->join("recipients","recipients.id","=","campaign_recipients.recipient_id")
        ->where("campaigns.created_by_user_id", '=', $userId)
        ->get();
		return $data;
	}
}
