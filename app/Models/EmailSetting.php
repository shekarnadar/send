<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    use HasFactory;
    // protected $table = 'campaign_redeemed_amount';

    protected $fillable = [
       'id', 'email','password','client_admin_id',
    ];

    public $timestamps = false;
}
