<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProductMapping extends Model
{
	use HasFactory;
	protected $table = 'company_product_mapping';
	 protected $fillable = [
		'company_id','product_id'
	];
	public function product(){
		return $this->hasMany('App\Models\Product', 'id', 'product_id');
	}
	public static function getCompanyProduct($withAjax,$params=null) {
		if($withAjax == 1){
				$compproduct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->with(['product'=>function($q) use($params){
						if($params['search']){
										$q->where('name','like','%'.$params['search'].'%');
						}
						if (!empty($params['min']) && !empty($params['max'])) {
										$q->whereBetween('price', [$params['min'], $params['max']]);
						}
				}]);
				$compProdct = $compproduct->get()->toArray();	
		}else{
			$compProdct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->with('product')->get();
		}
		return $compProdct;
	}
}
