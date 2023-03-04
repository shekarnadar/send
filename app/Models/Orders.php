<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipient;
use App\Models\User;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_product_redeem_details_id','order_id','tracking_id', 'status','order_response'
    ];

    public function recipientReedme(){
        return $this->belongsTo('App\Models\RecipientProductRedeemDetail', 'recipient_product_redeem_details_id','id');
    }

    public static function getAllLog($page = null){
        $client = \Auth::guard(getAuthGaurd())->user();
        if(getAuthGaurd() == 'manager'){
                $id = $client->parent_user_id;
        }else{
            $id = $client->id;
        }
 
        if(getAuthGaurd() == 'client_admin' ||getAuthGaurd() == 'manager' ){
            $data = Orders::whereHas('recipientReedme', function ($query)use($id) {
                $query->where('client_id','=',$id);
            })->with('recipientReedme.recipientDetails.recipientGroups','recipientReedme.productDetails', 'recipientReedme.campaignDetails');
        } else {
            $data = Orders::with('recipientReedme.recipientDetails.recipientGroups','recipientReedme.productDetails','recipientReedme.clientDetails.client', 'recipientReedme.campaignDetails');
        }
        if($page == true){
            $data->orderBy('id', 'DESC');
        }else{
            $data->orderBy('id', 'DESC')->get();
        }
        return $data;
    }
    
}
