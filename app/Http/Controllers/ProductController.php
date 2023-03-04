<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateProductRequest;
use App\Models\Product;
use App\Models\EProduct;
use App\Models\ProductCategoriesMaster;
use App\Models\ProductImage;
use App\Models\Client;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function allProductLists(Request $request)
    {
        // dd($categories)
        $isCompany = false;
        if (urlPrefix() == 'client-admin') {
            $isCompany = true;

            $test_data =  Product::leftjoin('company_product_mapping', 'company_product_mapping.product_id', 'products.id')
                ->select('products.*', 'company_product_mapping.product_id', 'company_product_mapping.company_id')
                ->where('company_product_mapping.company_id', null)
                ->get();
        }
        // $data = Product::getAll('all');

        // if (!empty($request->get('category'))) {
        //     $data = $data->where('category_id',$request->get('category'));
        // }
        // if($request->get('search')){
        //     $search = $request->get('search');
        //     $data->where('name','like','%'.$search.'%')->orWhere('code','like','%'.$search.'%')->orWhere('price','like','%'.$search.'%');
        // }

        // $data = $data->paginate(5);

        $data = Product::getAll('all', $request->all(), $isCompany);
        if (!empty($request->get('category'))) {
            $client = \Auth::guard(getAuthGaurd())->user();
            $data = $data->where('category_id', $request->get('category'));
        }
        if ($request->get('search')) {
            $search = $request->get('search');
            $data->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%')->orWhere('price', 'like', '%' . $search . '%');
        }

        if (urlPrefix() == 'client-admin')
            $data = $test_data->merge($data->get());
        else
            $data = $data->get();

        // dd($data);

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->productCategory->name;
                })
                ->addColumn('image', function ($row) {
                    $image = getImage(@$row->productDefaultImage->image, 'product');
                    return '<img src="' . $image . '" height="60" width="70"/>';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active ? 'Active' : 'Inacitve';
                })
                ->addColumn('action', function ($row) {
                    return  getOptions("product", $row->id, $row->is_active);
                })
                ->rawColumns(['action', 'description', 'image', 'status', 'category'])
                ->make(true);
        }

        //   dd($data);

        $categories = ProductCategoriesMaster::tree();
        return view('products.index', compact('categories', 'data'));
    }

    // render product view
    public function allProductsRender(Request $request)
    {
        $isCompany = true;

        $test_data =  Product::leftjoin('company_product_mapping', 'company_product_mapping.product_id', 'products.id')
            ->select('products.*', 'company_product_mapping.product_id', 'company_product_mapping.company_id')
            ->where('company_product_mapping.company_id', null)
            ->get();

        $data = Product::getAll('all', $request->all(), $isCompany);
        if (!empty($request->get('category'))) {
            $client = \Auth::guard(getAuthGaurd())->user();
            $data = $data->where('category_id', $request->get('category'));
        }
        if ($request->get('search')) {
            $search = $request->get('search');
            $data->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%')->orWhere('price', 'like', '%' . $search . '%');
        }

        if (urlPrefix() == 'client-admin') {
            $data = $data->where('is_active', 1);
            $data = $test_data->merge($data->get());
        } else
            $data = $data->get();

        $html = View::make('products._products_cards', ['data' => $data])->render();
        return Response::json(['html' => $html]);
    }

    public function view(Request $request,$id){
        if ($request->type == 'egift') {
            $product = EProduct::findorfail($id);
            return view('products.details', compact('product'));
        } else {
            $product = Product::getDetailById($id);
            $image = ProductImage::getImageById($id);
            if (!empty($product)) {
                return view('products.details', compact('product', 'image'));
            }
            abort(404);
        }
    }


    public function statusProduct($id)
    {
        try {
            $status = Product::toggleStatusById($id);
            if ($status == 1) {
                return response()->json([
                    'success' => true,
                    'message' => config('constants.PRODUCT_ACTIVE_SUCCESS')
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => config('constants.PRODUCT_INACTIVE_SUCCESS')
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }
    public function companyProducts()
    {
        return view('super-admin.products.company-products');
    }

    public function add()
    {
        $categories = ProductCategoriesMaster::tree();
        $clientProduct = array();
        $clients = Client::getAllClient();
        $title = "Add";
        return view('products.add-edit', compact('categories', 'clients', 'clientProduct', 'title'));
    }

    public function edit($id)
    {
        $product = Product::getDetailById($id);
        $clientProduct = $product->CompanyProductMapping->pluck('company_id')->toArray();
        $clients = Client::getAllClient();
        $categories = ProductCategoriesMaster::tree();
        $title = "Edit";
        if (!empty($product)) {
            return view('products.add-edit', compact('product', 'categories', 'clients', 'clientProduct', 'title'));
        }
        abort(404);
    }

    public function save(AddUpdateProductRequest $request)
    {
        try {
            $product = Product::saveProduct($request);
            if ($product['actionFlag'] == 'ADD') {
                return response()->json([
                    'success' => true,
                    'message' => config('constants.PRODUCT_ADDED_SUCCESS')
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => config('constants.PRODUCT_UPDATE_SUCCESS')
                ], 200);
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . 'on line' . $e->getLine() . 'on file' . $e->getFile();
            die();
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function delete($id)
    {
        try {
            Product::deleteById($id);

            return response()->json([
                'success' => true,
                'message' => config('constants.PRODUCT_DELETED_SUCCESS')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function swagStore()
    {
        return view('swag-store');
    }
}
