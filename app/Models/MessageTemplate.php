<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use HasFactory;

    public static function getDetails($id=null) {
        $q = MessageTemplate::select('*');
        if(!empty($id)){
            return $q->where('id',$id)->first();
        }
        return $q->orderBy('id', 'ASC')->first();
    }
}
