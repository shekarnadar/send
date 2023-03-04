<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallet';

    protected $fillable = [
        'user_id',
        'amount',
        'created_at',
        'pendingAmount',
        'availableBalance',
        'spentAmount',
        'buget'
    ];

    public function UserInfo(){
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }

    // public static function getAllWallet(){
    //     $userId = \Auth::guard(getAuthGaurd())->user()->id;
    //     $q = Wallet::with('userInfo')->select('*');

    //     if(getAuthGaurd() != 'super_admin' && !empty($userId)){
    //         $q->where('created_by_user_id', $userId);
    //     }

    //     return $q->orderBy('id', 'DESC')->get();

    // }

    public static function saveWallet($post){
        if(!empty($post['id'])){
            $wallet = Wallet::where('id', $post['id'])->first();
        } else {
            $wallet = new Wallet();
        }
        if(!empty($wallet->amount)){
            $wallet->amount = $post['amount'] + $wallet->amount;
        }else{
        $wallet->amount = $post['amount'];
        }
        $wallet->user_id = $post['user_id'];
        // $wallet->amount = $post['amount'];
        $wallet->save();
    }

}
