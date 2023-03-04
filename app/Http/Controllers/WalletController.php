<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\SuperAdmin\EmailSettingRequest;
use App\Models\Wallet;
use App\Models\User;

class WalletController extends Controller
{

    public function allWalletLists(Request $request){
        $user = User::where('role_master_id', 3)->select('*')->get();

        if($request->ajax()){
            $data = Wallet::select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function ($row) {
                //     return $row->is_active ? 'Active' : 'Inacitve';
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('super-admin.wallet.index',compact('user'));
        // return view('super-admin.wallet.index');

    }

    // public function add(){
    //     $categories=ProductCategoriesMaster::tree();
    //     return view('products.add-edit',compact('categories'));
    // }

    // public function edit($id) {
    //     $product = Product::getDetailById($id);
    //     $categories=ProductCategoriesMaster::tree();
    //     if(!empty($product)){
    //         return view('products.add-edit',compact('product','categories'));
    //     }
    //     abort(404);
    // }

    // public function save(AddUpdateProductRequest $request)
    // {
    //     try {
    //         $product = Product::saveProduct($request);
    //         if($product['actionFlag'] == 'ADD') {
    //             return response()->json(['success' => true,
    //             'message' => config('constants.PRODUCT_ADDED_SUCCESS')
    //         ], 200);
    //         } else {
    //             return response()->json(['success' => true,
    //             'message' => config('constants.PRODUCT_UPDATE_SUCCESS')
    //         ], 200);
    //         }
    //     } catch(\Exception $e){
    //         echo $e->getMessage(). 'on line'. $e->getLine(). 'on file'.$e->getFile();
    //         die();
    //         return response()->json(['success' => false,
    //             'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
    //     }
    // }

}
