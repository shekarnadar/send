<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagignation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['page', 'total_page','created_at']; 


}
