<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipient;
use App\Models\CampaignRedeemedAmount;

class RecipientProductRedeem extends Model
{
    use HasFactory;

    protected $table = 'recipient_product_redeem';

    public static function saveRedeem($post)
    {
        $model = new RecipientProductRedeem();
        $model->campaign_recipient_id = $post['campaign_recipient_id'];
        $model->product_id = $post['product_id'];
        $model->is_redeemed = 1;
        $model->redeemed_at = getFormatedDate('','Y-m-d H:i:s');
        $model->save();

        // update recipient data
        $recipient = Recipient::where('id', $post['recipient_id'])->first();
        $recipient->first_name = $post['first_name'];
        $recipient->last_name = $post['last_name'];
        $recipient->email = trim($post['email']);
        $recipient->phone = $post['phone'];
        $recipient->city = $post['city'];
        $recipient->state = $post['state'];
        $recipient->country = $post['country'];
        $recipient->address_line_1 = $post['address'];
        $recipient->postal_code = $post['postal_code'];
        $recipient->save();

        // redeemed product amount save
        if (CampaignRedeemedAmount::where('campaign_id', $post['campaign_id'])->exists()) {
            $reedems = CampaignRedeemedAmount::where('campaign_id', $post['campaign_id'])->first();
            $newAmount = $reedems->amount + $post['amount'];
            $flight = CampaignRedeemedAmount::updateOrCreate(
                ['campaign_id' => $post['campaign_id']],
                ['amount' => $newAmount],
                ['client_id' => $post['client_id']]
            )->where('campaign_id', $post['campaign_id']);
        }else{
            $reedem = new CampaignRedeemedAmount();
            $reedem->campaign_id = $post['campaign_id'];
            $reedem->amount = $post['amount'];
            $reedem->client_id = $post['client_id'];
            $reedem->save();
        }
       

        // Recipient product redeemed details save
            $redeemDetail = new RecipientProductRedeemDetail();
            $redeemDetail->recipient_id = $post['recipient_id'];
            $redeemDetail->product_id = $post['product_id'];
            $redeemDetail->campaign_id = $post['campaign_id'];
            $redeemDetail->campaign_recipient_id = $post['campaign_recipient_id'];
            $redeemDetail->client_id = $post['client_id'];
            $redeemDetail->save();

            return $redeemDetail->id;


    }
    public static function saveManual($post)
    {
        $model = new RecipientProductRedeem();
        $model->campaign_recipient_id = $post['campaign_recipient_id'];
        $model->product_id = $post['product_id'];
        $model->is_redeemed = 1;
        $model->redeemed_at = getFormatedDate('','Y-m-d H:i:s');
        $model->save();

        
        // redeemed product amount save
        if (CampaignRedeemedAmount::where('campaign_id', $post['campaign_id'])->exists()) {
            $reedems = CampaignRedeemedAmount::where('campaign_id', $post['campaign_id'])->first();
            $newAmount = $reedems->amount + $post['amount'];
            $flight = CampaignRedeemedAmount::updateOrCreate(
                ['campaign_id' => $post['campaign_id']],
                ['amount' => $newAmount],
                ['client_id' => $post['client_id']]
            )->where('campaign_id', $post['campaign_id']);
        }else{
            $reedem = new CampaignRedeemedAmount();
            $reedem->campaign_id = $post['campaign_id'];
            $reedem->amount = $post['amount'];
            $reedem->client_id = $post['client_id'];
            $reedem->save();
        }
       

        // Recipient product redeemed details save
            $redeemDetail = new RecipientProductRedeemDetail();
            $redeemDetail->recipient_id = $post['recipient_id'];
            $redeemDetail->product_id = $post['product_id'];
            $redeemDetail->campaign_id = $post['campaign_id'];
            $redeemDetail->campaign_recipient_id = $post['campaign_recipient_id'];
            $redeemDetail->client_id = $post['client_id'];
            $redeemDetail->save();

            return $redeemDetail->id;


    }
}
