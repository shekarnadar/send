<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public static function saveImages($product){
        ProductImage::where('product_id', $product['productId'])->delete();
        
        $productImg = new ProductImage();
        $productImg->product_id = $product['productId'];
        $productImg->image = $product['image'];
        $productImg->save();
    }

    public static function getImageById($id){
        return ProductImage::where('product_id', $id)->first();
    }
}
