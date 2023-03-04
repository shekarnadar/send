<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipient;
use App\Models\CampaignRedeemedAmount;
use App\Jobs\SendEmailJob;
use App\Jobs\EmailSetting;
use App\Jobs\CampaignRecipient;
use App\Models\Wallet;
use App\Models\Notification;
use DB;
use App\Http\Controllers\QwikCilverController;
use App\Models\QwickGiftOrder;




class Campaign extends Model
{
	use HasFactory;
     
	public function user(){
		return $this->belongsTo('App\Models\User', 'created_by_user_id','id');
	}

	public function group(){
		return $this->belongsTo('App\Models\RecipientGroup', 'group_id','id');
	}

	public function emailSettingInfo(){
		return $this->belongsTo('App\Models\EmailSetting', 'created_by_user_id','client_admin_id');
	}

	public function client(){
		return $this->belongsTo('App\Models\Client', 'client_id','id');
	}

	// public function abcd(){
	//     return $this->belongsTo('App\Models\Recipient', 'campaign_id','id');
	// }
	public function campaignRecipient(){
		return $this->hasMany('App\Models\CampaignRecipient', 'campaign_id','id');
	}

	public function totalReadme(){
		return $this->hasMany('App\Models\CampaignRecipient', 'campaign_id','id')->where('is_readme',1);
	}
	public function campaignProduct(){
		return $this->hasMany('App\Models\CampaignProductMapping', 'campaign_id','id');
	}
	public function campaignEgiftProduct(){
		return $this->hasOne('App\Models\CampaignProductMapping', 'campaign_id','id')->latestOfMany();
	}

	public function clientDetail(){
		return $this->belongsTo('App\Models\Client', 'client_id','id');
	}

	public function multipleCampaignProduct(){
		return $this->belongsToMany('App\Models\Product','campaign_product_mapping','campaign_id');
	}

	public function reedemedAmount(){
		return $this->belongsTo('App\Models\CampaignRedeemedAmount', 'id','campaign_id');
	}

    public function recipientInfo(){
		return $this->belongsTo('App\Models\CampaignRecipient', 'id','campaign_id');
	}

	public static function getClientCampaign($id){
		$q = Campaign::with('reedemedAmount','group','user','clientDetail')->withCount('campaignRecipient','totalReadme')->select('*')->where('client_id',$id)->orderBy('id', 'DESC')->get();
		return $q;
	}

	public static function getAllCampaign($page = null){
		$user = \Auth::guard(getAuthGaurd())->user();
		if(getAuthGaurd() == 'manager'){
			$userId = $user['parent_user_id'];
		}else{
			$userId =  $user['id'];
		}

		$q = Campaign::with('reedemedAmount','group','user','clientDetail')->withCount('campaignRecipient','totalReadme')->select('*');
		if(getAuthGaurd() != 'super_admin' && !empty($userId)){
			$q->where('created_by_user_id', $userId);
			// 

		}
		if($page == true){
			return $q->orderBy('id', 'DESC');
		}else{
			return $q->orderBy('id', 'DESC')->get();
		}
		
	}


	public static function saveCampaign($post) {
		$user = \Auth::guard(getAuthGaurd())->user();
		if(getAuthGaurd() == 'manager'){
			$userId = $user['parent_user_id'];
		}else{
			$userId =  $user['id'];
		}

		$camp = new Campaign();

		$camp->created_by_user_id = $userId;
		$camp->name = $post['campaign_name'];
		$camp->client_id = $user->client_id;
		$camp->approval_status = 0;
		$camp->start_date = !empty($post['start_date']) ? getFormatedDate($post['start_date'],'Y-m-d') : NULL;
		$camp->end_date = !empty($post['end_date']) ? getFormatedDate($post['end_date'],'Y-m-d') : NULL;
		$camp->before_days = !empty($post['before_days']) ? $post['before_days'] : NULL;
		$camp->event_type = !empty($post['event_type']) ? $post['event_type'] : NULL;
		$camp->type = !empty($post['campaign_type']) ? $post['campaign_type'] : NULL;
		$camp->template_id = !empty($post['template_type']) ? $post['template_type'] : NULL;
		$camp->budget = !empty($post['budget']) ? $post['budget'] : NULL;
		$camp->recipient_type = $post['recipient_type'];
		$camp->group_id = !empty($post['group_id']) ? $post['group_id'] : 0;
		$camp->video = !empty($post['video']) ? $post['video'] : NULL;
		$camp->maxprice = $post['productMaxPrice'];
		$camp->subject = !empty($post['subject']) ? $post['subject'] : NULL;
		$camp->template_name = !empty($post['template_name']) ? $post['template_name'] : NULL;
		$camp->is_egift_campaign = !empty($post['is_egift'])? $post['is_egift'] : 0;

		if(!empty($post['email']) && $post['email'] == 'on'){
			$camp->is_mail = 1;
			$camp->description = $post['email_description'];
		}
		if(!empty($post['whatsapp']) && $post['whatsapp'] == 'on'){
			$camp->is_whatsapp = 1;
		}


		$camp->save();
		$walletDetails = Wallet::where('user_id',$user->id)->first();

		// THIS CODE WILL BE REMOVED AFTER WALLET FEATURE APPROVED
		
		if(!empty($walletDetails)){
			$sum = $walletDetails['pendingAmount'] + $camp->budget;
			$availableBalance = $walletDetails['amount'] -  $sum;
		} else {
			$sum = $camp->budget;
			$availableBalance = $sum;
		}

		$buget = $camp->budget;		
		Wallet::where('user_id',$user->id)->update(['pendingAmount'=> $sum,'availableBalance'=>$availableBalance,'buget'=>$buget ]);



		



		return $camp;

    }

	public static function getDetailById($id){
		return Campaign::where('id',$id)->first();
	}

	public static function approveRejectCampaign($id,$status){

		$data = Campaign::with('emailSettingInfo','user')->with('campaignEgiftProduct')->where(['id' => $id])->first();
		$data_notification['campaign_id'] = $id;
		if($status==2/*$data->approval_status == 0*/) {
			Campaign::where(['id' => $id])->update(['approval_status' => 2, 'is_active' => 0]);
			$data_notification['type'] = 'campaign_rejected';
		} else {
			Campaign::where(['id' => $id])->update(['approval_status' => 1, 'is_active' => 1]);
			$data_notification['type'] = 'campaign_approved';
			if($data->type == 'instant'){
 
				// Mail code starts
				$recipients = $data->campaignRecipient;

				if(count($recipients) > 0) {
					foreach($recipients as $recep) {
						
						if($recep->recipient->is_active == '1' && $recep->recipient->is_deleted == '0'){
							//check for gift
							if($data->is_egift_campaign == 1){
								\DB::beginTransaction();  
								try{
									\DB::commit();
									$orderResponse = parent::creteEgiftOrder($recep,@$data);
									print_r($orderResponse);
								} catch (\Exception $e) {
									echo "ca";
									\DB::rollBack();
								}
							}
							if($data->is_whatsapp == 1) {
									// Short Url starts
									$urlkey = $recep->urlkey;
									$shortData = DB::select("SELECT * FROM short_urls WHERE default_short_url = '$urlkey'");
									$urlRedeem = url($shortData[0]->default_short_url);
									
									// Short Url ends
									$sendMessage['phone'] = $recep->recipient->phone;
									//$sendMessage['redeem_link'] = url($recep->redeem_link);
									$sendMessage['redeem_link'] = $urlRedeem;
									$sendMessage['name'] = ucwords($recep->recipient->first_name.' '.$recep->recipient->last_name);
									$sendMessage['client_user_id'] =$data->clientDetail->id ;
                                    $sendMessage['recipient_id'] = $recep->recipient->id;
                                    $sendMessage['campaign_id'] = $id;
                                    $sendMessage['template_name'] = $data->template_name;
                                    $sendMessage['broadcast_name'] = $data->template_name;
                                    $sendMessage['url'] = $data->clientDetail->url;
                                    $sendMessage['token'] = $data->clientDetail->token;
                                    sendWhatsappMessage($sendMessage);
									$updateStatus['is_sent_whatsapp'] = 1;
							}
							if($data->is_mail == 1){
								  $updateStatus['is_sent_email'] = 1;
								  $emailData['request'] = 'send_redeem_gift_link_mail';
								  $emailData['name'] = ucwords($recep->recipient->first_name.' '.$recep->recipient->last_name);
									$emailData['email'] = trim($recep->recipient->email);
									if(empty($data['subject']) || $data['subject'] == 'NULL'){
										$emailData['subject'] = 'Happy Diwali From Ek Matra (You have received a Gift)';
									}else{
										$emailData['subject'] = $data['subject'];
									}
									
									$emailData['client_name'] = $data->clientDetail->name;
									$emailData['redeem_link'] = url($recep->redeem_link);
									$emailData['client_user_id'] =$data->clientDetail->id ;
									$emailData['recipient_id'] = $recep->recipient->id;
									$emailData['campaign_id'] = $id;
									
								    $description  = $data->description;
								     if(empty($data['user']['client_admin_logo']) || $data['user']['client_admin_logo'] == 'NULL'){
						                $emailData['logo'] = NULL;

						            }else{
						                 $emailData['logo'] = getImage($data['user']['client_admin_logo'],"logo");
						            }
						            $emailData['email_description'] = emilDescription($data->template_id,$recep->recipient->first_name,$data->clientDetail->name,$recep->recipient->last_name,$description);

									

									// if(!empty($data->emailSettingInfo)){
									// 	$clientSettingEmail = $data->emailSettingInfo->email;
									// 	$clientSettingPassword = $data->emailSettingInfo->password;
									// 	$emailData['from_email'] =$data->emailSettingInfo->email;
									// 	setEmailConfig($clientSettingEmail, $clientSettingPassword);
									// }else{
										
									// 	$emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
									// 	$clientSettingEmail = 'info@send1.in';
									// 	$clientSettingPassword = 'osflraucpesetzvy';

									// 	setEmailConfig($clientSettingEmail, $clientSettingPassword);
									// }
									dispatch(new SendEmailJob($emailData));
							}
							$camp = \App\Models\CampaignRecipient::where('id',$recep->id)->update($updateStatus);
						}
					}
				}
				// mail code ends
			}
		}

		$data_notification['user_id'] = $data['created_by_user_id'];
		$data_notification['title'] = $data['name'];
		$data_notification['description'] = 'Campaign Created By '.$data->user->first_name;
		$data_notification['company_id'] = $data->client_id;
		
		Notification::saveNotification($data_notification); 
		return 1;
	}
	//crete egift order
	public  function creteEgiftOrder($recp,$data) {
		$qwickGift['first_name'] = $recp->recipient->first_name;
		$qwickGift['lastname'] = $recp->recipient->lastname;
		$qwickGift['email'] = @$recep->recipient->email;
		$qwickGift['phone'] = @$recep->recipient->phone;
		$qwickGift['line1'] = @$recep->recipient->address_line_1;
		$qwickGift['line2'] = @$recep->recipient->address_line_2;
		$qwickGift['city'] = @$recep->recipient->cityName->name;
		$qwickGift['state'] = @$recep->recipient->stateName->name;
		$qwickGift['country'] = @$recep->recipient->countryName->name;
		$qwickGift['postcode'] = @$recep->recipient->postal_code;
		$qwickGift['amount'] = @$recep->egift_price;
		$qwickGift['sku'] = @$data->campaignEgiftProduct->eproduct->sku;
		$json_decode = json_decode($data->campaignEgiftProduct->eproduct->json_response,true);
	 	$qwickGift['currency'] = @$json_decode['currency']['numericCode'];
	 	$obj = new QwikCilverController();
        $orders =  $obj->createOrder($qwickGift);
        // $savequickGift['campaign_id'] = $data->id;
        // $savequickGift['campaign_recipient_id'] = $recep->id;
        // $savequickGift['recipient_id'] = $recep->recipient->id;
        //  QwickGiftOrder::create($savequickGift);

		return $orders;
	}
	public static function getCampaingsCount() {
		$user = \Auth::guard(getAuthGaurd())->user();
		$client_id =$user->client_id;
		if(getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager'){
			$campaignList = Campaign::where(['client_id'=>$client_id])->get();
		} else {
			$q = Campaign::select('*');
			$campaignList=$q->orderBy('id', 'DESC')->where('is_deleted',0)->get();
		}
		return $campaignList->count();
	}
	public static function getClientCampaingsCount($id) {
		$campaignList = Campaign::where(['client_id'=>$id])->count();
		return $campaignList;
	}

	public static function totalCampagianGiftSentCount($id) {
		$user = \Auth::guard(getAuthGaurd())->user();

		$campaign = Campaign::selectRaw('count(campaign_id) as total_recipients')->join('campaign_recipients', 'campaign_recipients.campaign_id', 'campaigns.id')->where('client_id', $user->client_id)->where('campaigns.id',$id)->groupBy('campaign_id')->get();
		
		return collect($campaign)->sum('total_recipients');
	}

	public static function totalRecipientsCountByClient($id) {
		$recipients = Recipient::selectRaw('count(id) as total_count')
		->where('client_id', $id)
		->where('is_deleted', 0)
		->count();

		return $recipients;
	}

	public static function totalCampagianGiftTransistCount($id = null) {
		$user = \Auth::guard(getAuthGaurd())->user();

		$transist_count = Orders::join('recipient_product_redeem_details', 'recipient_product_redeem_details.id', 'orders.recipient_product_redeem_details_id')
		->where('client_id', $user->client_id)
		->where('pickrr_order_status_code', 'OT');
		if($id)
			$transist_count->where('recipient_product_redeem_details.campaign_id',$id);

		$transist_count = $transist_count->count();

		// dd($transist_count);
		
		 return $transist_count;
	}

	public static function totalCampagianGiftDeliveredCount($id = null) {
		$user = \Auth::guard(getAuthGaurd())->user();

		$delivery_count = Orders::join('recipient_product_redeem_details', 'recipient_product_redeem_details.id', 'orders.recipient_product_redeem_details_id')
		->where('client_id', $user->client_id)
		->where('pickrr_order_status_code', 'DL');
		if($id)
			$delivery_count->where('recipient_product_redeem_details.campaign_id',$id);

		$delivery_count = $delivery_count->count();

		// dd($transist_count);
		
		 return $delivery_count;
	}

	

	public static function totalGiftSentCount($callFrom = null) {
		$user = \Auth::guard(getAuthGaurd())->user();

		// $campaign = Campaign::selectRaw('count(campaign_id) as total_gift')->join('campaign_product_mapping', 'campaign_product_mapping.campaign_id', 'campaigns.id');

		$campaign = Campaign::selectRaw('count(campaign_id) as total_recipients')->join('campaign_recipients', 'campaign_recipients.campaign_id', 'campaigns.id');

		if($callFrom != 'admin'){
		   $campaign = $campaign->where('client_id', $user->client_id);
		}

		$campaign = $campaign->groupBy('campaign_id')->get();
// dd($campaign);
		return collect($campaign)->sum('total_recipients');
	}
	public static function totalClientGiftSentCount($id) {
		
		$campaign = Campaign::selectRaw('count(campaign_id) as total_recipients')->join('campaign_recipients', 'campaign_recipients.campaign_id', 'campaigns.id')->where('client_id', $id)->groupBy('campaign_id')->get();

		return collect($campaign)->sum('total_recipients');
	}
	public static function totalGiftCampiganRedeemedCount($id) {
		$user = \Auth::guard(getAuthGaurd())->user();

		$redeemedGift = Campaign::selectRaw('count(recipient_product_redeem.id) as total_redeemed_gift')
		->join('campaign_recipients', 'campaign_recipients.campaign_id', 'campaigns.id')
		->join('recipient_product_redeem', 'recipient_product_redeem.campaign_recipient_id', 'campaign_recipients.id')->where('campaigns.id',$id)->where('client_id', $user->client_id);
		$redeemedGift = $redeemedGift->where('recipient_product_redeem.is_redeemed', 1)
		->groupBy('campaign_recipient_id')->get();

		return collect($redeemedGift)->sum('total_redeemed_gift');
	}

	public static function totalGiftRedeemedCount($callFrom = null) {
		$user = \Auth::guard(getAuthGaurd())->user();

		$redeemedGift = Campaign::selectRaw('count(recipient_product_redeem.id) as total_redeemed_gift')
		->join('campaign_recipients', 'campaign_recipients.campaign_id', 'campaigns.id')
		->join('recipient_product_redeem', 'recipient_product_redeem.campaign_recipient_id', 'campaign_recipients.id');

		if($callFrom != 'admin'){
		   $redeemedGift = $redeemedGift->where('client_id', $user->client_id);
		}

		$redeemedGift = $redeemedGift->where('recipient_product_redeem.is_redeemed', 1)
		->groupBy('campaign_recipient_id')->get();

		return collect($redeemedGift)->sum('total_redeemed_gift');
	}

	public static function totalRecipientsCount($callFrom = null) {
		$recipients = Recipient::selectRaw('count(id) as total_count')
		->where('is_deleted', 0)
		->groupBy('id')->get();

		return collect($recipients)->sum('total_count');
	}

	// get all active and non deleted campaigns
	public static function getAllActiveCampaign($type){
		$q = Campaign::where(['approval_status' => 1, 'is_active' => 1, 'is_deleted' => 0, 'type' => $type]);
		if($type == 'bulk'){
			$q = $q->whereDate('start_date', getFormatedDate('', 'Y-m-d'));
		}

		if($type == 'individual'){
		   $q = $q->whereDate('end_date','>=',getFormatedDate('', 'Y-m-d'));
		}
		return $q->get();
	}
    public static function maximumCampBudget($id) {
    	$user = \Auth::guard(getAuthGaurd())->user();
		if(getAuthGaurd() == 'manager'){
			$id = $user['parent_user_id'];
		}else{
			$id =  $user['id'];
		}
		$maximumBudget = Campaign::where('id',$id)->whereBetween('created_at', [now()->subDays(30), now()])->where('created_by_user_id',$id)->sum('budget');
		//$maximumBudget = Campaign::where('created_by_user_id',$id)->sum('budget');
		return $maximumBudget;
    }
	public static function maximumBudget() {
		$user = \Auth::guard(getAuthGaurd())->user();
		if(getAuthGaurd() == 'manager'){
			$id = $user['parent_user_id'];
		}else{
			$id =  $user['id'];
		}
		$maximumBudget = Campaign::whereBetween('created_at', [now()->subDays(30), now()])->where('created_by_user_id',$id)->sum('budget');
		//$maximumBudget = Campaign::where('created_by_user_id',$id)->sum('budget');
		return $maximumBudget;
	}
}
