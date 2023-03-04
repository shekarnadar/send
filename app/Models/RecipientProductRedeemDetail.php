<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Recipient;
use App\Models\CampaignRecipient;
use App\Models\Client;


class RecipientProductRedeemDetail extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'recipient_id','product_id','campaign_id', 'campaign_recipient_id','client_id', 'approval_status','pickrr_order_status_code','pickrr_order_status','is_completed','pickrr_current_status_time'
    ];
 
    public function recipientDetails(){
        return $this->belongsTo('App\Models\Recipient', 'recipient_id','id');
    }

    // public function clientDetails(){
    //     return $this->belongsTo('App\Models\Client', 'client_id','id');
    // }

    public function clientDetails(){
        return $this->belongsTo('App\Models\User', 'client_id','id');
    }    

    public function campaignDetails(){
        return $this->belongsTo('App\Models\Campaign', 'campaign_id','id');
    }  

    public function productDetails(){
        return $this->belongsTo('App\Models\Product', 'product_id','id');
    }

    public function productImage(){
        return $this->belongsTo('App\Models\ProductImage', 'product_id','product_id');
    }

     public function orders(){
        return $this->hasOne('App\Models\Orders', 'recipient_product_redeem_details_id');
    }


    public static function toggleStatusById($id,$status){
        $data = RecipientProductRedeemDetail::where(['id' => $id])->first();
        if($status==2) {
            RecipientProductRedeemDetail::where(['id' => $id])->update(['approval_status' => 2]);
        } else {
            RecipientProductRedeemDetail::where(['id' => $id])->update(['approval_status' => 1]);
        }
        return 1;
    }

    public static function getAllRecord($page = null){
        $data = RecipientProductRedeemDetail::with('recipientDetails', 'clientDetails', 'productDetails')->select('*');
        if($page == true){
            $data = $data->orderBy('id','DESC');
        }else{
             $data = $data->orderBy('id','DESC')->get();
        } 

        return $data;
    }

    public static function getRecordById($id){
        $redeemedDetail = RecipientProductRedeemDetail::with('recipientDetails', 'clientDetails', 'productDetails')->where('id',$id)->first();        
        return $redeemedDetail;
    }

    // public function recipientDetails(){
    //     return $this->hasMany('App\Models\CampaignRecipient', 'campaign_id','id');
    // }
}
