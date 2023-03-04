<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\CompanyProductMapping;

class Product extends Model
{
    use HasFactory;

    public function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategoriesMaster', 'category_id', 'id');
    }

    public function CompanyProductMapping()
    {
        return $this->hasMany('App\Models\CompanyProductMapping', 'product_id', 'id');
    }

    public function productDefaultImage()
    {
        return $this->hasOne('App\Models\ProductImage', 'product_id', 'id')->where('is_default', 1);
    }


    public static function saveProduct($request)
    {
        $post = $request->all();
        //print_r($post['product_visibility']);
        //exit;
        $fileName = '';
        $actionFlag = 'ADD';

        if (!empty($post['id'])) {
            $product = Product::where('id', $post['id'])->first();
            $actionFlag = "UPDATE";
            // $fileName = ProductImage::getImageById($post['id'])->image;
        } else {
            $product = new Product();
            $product->code = generateRandomStringToken('code', 6);
        }

        $product->name = ucwords($post['pname']);
        $product->category_id = ucwords($post['category']);

        $product->description = $post['description'];

        $product->price = $post['pprice'];
        $product->created_by_user_id = \Auth::guard(getAuthGaurd())->user()->id;
        $product->is_active = 1;
        if ($request->product_visibility) {
            $product->visibility = 1;
        }
        $product->save();

        if ($request->hasFile('image')) {
            $fileName = uploads3File('product', $request);
            $productImage = ProductImage::where('product_id', $product->id)->first();
            if (!empty($productImage)) {
                $productImage->image = $fileName;
            } else {
                $productImage = new ProductImage();
                $productImage->image = $fileName;
                $productImage->product_id = $product->id;
                $productImage->is_default = 1;
            }
            $productImage->save();
        }
        if ($request->product_visibility) {
            CompanyProductMapping::where('product_id', $product->id)->delete();
            foreach ($request->product_visibility as $productVisibility) {
                CompanyProductMapping::Create([
                    'company_id' => $productVisibility,
                    'product_id' => $product->id
                ]);
            }
        }

        $productId = $product->id;
        return ['image' => $fileName, 'productId' => $productId, 'actionFlag' => $actionFlag];
    }

    public static function getDetailById($id)
    {
        return Product::with('CompanyProductMapping')->where('id', $id)->first();
    }

    public static function deleteById($id)
    {
        // return Product::where('id',$id)->delete();
        $product = Product::where('id', $id)->first();
        $product->is_deleted = 1;
        $product->save();

        if ($product->CompanyProductMapping()) {
            CompanyProductMapping::where('product_id', $id)->delete();
        }
    }

    public static function getAll($type = null, $post = [], $isCompany = false)
    {

        // $test_data =  \DB::table('products')
        //     ->leftjoin('company_product_mapping', 'company_product_mapping.product_id', 'products.id')
        //     ->select('products.*', 'company_product_mapping.product_id', 'company_product_mapping.company_id')
        //     ->where('company_product_mapping.company_id', null)
        //     ->get();

        // $test_data1 =   \DB::table('products')
        //     ->leftjoin('company_product_mapping', 'company_product_mapping.product_id', 'products.id')
        //     ->select('products.*', 'company_product_mapping.product_id', 'company_product_mapping.company_id')
        //     ->where('company_product_mapping.company_id', 81)
        //     ->get();

      

        $q = Product::select('*')->where('is_deleted', 0);

        if ($isCompany) { 
            $clientId = $client = \Auth::guard(getAuthGaurd())->user()->client_id;
            $q = Product::whereHas('CompanyProductMapping', function ($q) use ($clientId) {
                $q->where('company_id', $clientId);
            }); 
            // dd($test_data->merge($q->get()));
        }

        if (!empty($post['minPrice']) && !empty($post['maxPrice'])) {
            $q->whereBetween('price', [$post['minPrice'], $post['maxPrice']]);
        }

        if ($type == 'all') {
            $q = $q->where(['is_deleted' => 0]);

            if (!empty($post['price_order'])) {
                if ($post['price_order'] == 'price_low_to_high') {
                    $q = $q->orderBy('price', 'ASC');
                }

                if ($post['price_order'] == 'price_high_to_low') {
                    $q = $q->orderBy('price', 'DESC');
                }
            } else {
                $q = $q->orderBy('id', 'DESC');
            }

            return $q;
        } else {
            return $q->orderBy('id', 'DESC')->where(['is_deleted' => 0, 'is_active' => 1]);
        }
    }

    public static function toggleStatusById($id)
    {
        $data = Product::select('is_active')->where(['id' => $id])->first();

        if ($data->is_active) {
            Product::where(['id' => $id])->update(['is_active' => 0]);
            return 0;
        } else {
            Product::where(['id' => $id])->update(['is_active' => 1]);
            return 1;
        }
    }

    public static function productPrice($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        return $product;
    }

    public static function topSellingProduct()
    {
        $topSellingProduct = Product::with('productDefaultImage')->select('*')->where(['is_active' => 1, 'is_deleted' => 0])->orderBy('id', 'desc')->limit(10)->get();
        return $topSellingProduct;
    }

    public static function maxPriceOfProducts($ids)
    {
        $explode = explode(',', $ids);

        $maxPriceOfProducts = Product::whereIn('id', $explode)->selectRaw("max(price) as max_price")->first();

        if (!empty($maxPriceOfProducts)) {
            return $maxPriceOfProducts->max_price;
        }

        return 0;
    }
}
