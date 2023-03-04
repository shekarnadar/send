<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class CampaignRedeemedAmount extends Model
{
    use HasFactory;
    protected $table = 'campaign_redeemed_amount';
    protected $fillable = [
        'amount',
        'client_id',
        'campaign_id',
    ];
    public static function reedemedBudget() {
        $user = \Auth::guard(getAuthGaurd())->user();
        if(getAuthGaurd() == 'manager'){
            $id = $user['parent_user_id'];
        }else{
            $id =  $user['id'];
        }

        $reedemedBudget = CampaignRedeemedAmount::whereBetween('created_at', [now()->subDays(6), now()])->where('client_id',$id)->sum('amount');
        return $reedemedBudget;
    }

    // public static function budget() {
    //     $id = \Auth::guard(getAuthGaurd())->user()->id;
    //     $reedemedBudget = CampaignRedeemedAmount::where('campaign_id',253)->sum('amount');
    //     return $reedemedBudget;
    // }

}
