<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EProduct extends Model
{
		use HasFactory;

		protected $table = 'e_products';

		// save category
		public static function saveProduct($post){
				$model = new EProduct();
				$model->e_product_category_id = 1;    // it will change dynamically if all categories will be available
				$model->sku = $post['sku'];
				$model->name = $post['name'];
				$model->price = $post['currency']['numericCode'];
				$model->description = null;// @$post['description'];
				$model->json_response = json_encode($post);
				$model->save();
		}    

		public static function getAllProducts($params=null){
				$data = EProduct::query();
				if($params['search']){
						$data->where('name','like','%'.$params['search'].'%');
				}
				if (!empty($parms['minPrice']) && !empty($parms['maxPrice'])) {
						$data->whereBetween('min_price', [$parms['minPrice'], $parms['maxPrice']])
							->orWhereBetween('max_price', [$parms['minPrice'], $post['maxPrice']]);
				}
				return $data->get();
			  
		}
}
