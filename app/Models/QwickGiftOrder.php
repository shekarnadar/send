<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QwickGiftOrder extends Model
{
	use HasFactory;

    protected $table = 'qwick_gift_order';
    protected $fillable = ['campaign_id','campaign_recipient_id','recipient_id','status','order_id','refno','cancel','currency','payments'];
}
