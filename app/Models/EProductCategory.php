<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EProductCategory extends Model
{
    use HasFactory;
    
    protected $table = 'e_product_categories';

    // save category
    public static function saveCategory($post){
        $model = new EProductCategory();
        $model->category_id = $post['id'];
        $model->name = $post['name'];
        $model->description = $post['description'];
        $model->save();
    }

}
