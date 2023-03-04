<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateWalletRequest;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Campaign;
use App\Models\CampaignRedeemedAmount;
use App\Models\CampaignRecipient;


class WalletController extends Controller
{
    public function allWalletLists(Request $request){ //super admin index
        if($request->ajax()){
            $data = Wallet::select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('userName', function ($row) {
                    if(!empty($row->userInfo)){
                        return $row->userInfo->first_name.' '.$row->userInfo->last_name;
                    }
                })
                ->addColumn('action', function ($row) {
                    $record = "";
                    // $record .= ' <a href="'.url('super-admin/view-product',$row->id).'" class="btn btn-default">View</a>';
                    $record .= ' <a href="'.url('super-admin/edit-wallet',$row->id).'" class="btn btn-primary">Edit</a>';

                    // $urlPrefix = urlPrefix();
                    // $viewAction = url($urlPrefix."/view-product", $row->id);
                    // $editAction = url($urlPrefix."/edit-product", $row->id);
                    // $record .= ' <a href="'.$viewAction.'" class="btn btn-default">View</a>';
                    // if(urlPrefix() == 'super-admin') {
                    // $record .= ' <a href="'.$editAction.'" class="btn btn-default">Edit</a>';
                    // $record .= ' <button class="btn btn-default" onClick="deleteData('.$row->id.')">
                    //                         Delete
                    //     </button>';
                    // }
                    return $record;
                })

             ->rawColumns(['action'])
            ->make(true);
        }
        return view('super-admin.wallet.index');
    }

    public function add(){ //add
        $user = User::where(['role_master_id' => 3, 'is_active' => 1])->select('*')->get();
        return view('super-admin.wallet.add-edit',compact('user'));
    }

    public function edit($id){ //edit
        // $wallet = Wallet::getDetailById($id);
        // $user = User::where('id', $id)->select('*')->first();
        // dd($user);
        $wallet = Wallet::with('userInfo')->where('id', $id)->select('*')->first();
        $user = User::where(['role_master_id' => 3, 'is_active' => 1])->select('*')->get();

        if(!empty($wallet)){
            return view('super-admin.wallet.add-edit',compact('wallet', 'user'));
        }
        abort(404);
    }

    public function save(Request $request) //save
    {
        try {
            Wallet::saveWallet($request->all());

            return response()->json(['success' => true,
                'message' => config('constants.WALLET_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

    /* client admin index */
    public function walletLists(Request $request){

        $userId = \Auth::guard(getAuthGaurd())->user()->id;

        $wallet = Wallet::with('userInfo')->where('user_id', $userId)->first();
        $walletAmount = isset($wallet->amount) ? $wallet->amount : 0;

		$maximumBudget = Campaign::where('created_by_user_id',$userId)->sum('budget');
        //add by anmol
        $newpendingAmount = $maximumBudget;
        $pendingAmount = $wallet['pendingAmount'];
        $spentAmount = $wallet['spentAmount'];
        $availableBalance = ($wallet['availableBalance'] == 0 ) ? $wallet->amount : $wallet['availableBalance']; 

        return view('client-admin.wallet.index',compact('walletAmount', 'pendingAmount', 'spentAmount','availableBalance'));

    }

    public function walletCampaign(Request $request) {
        if($request->ajax()){
        $data = CampaignRecipient::campaignRecipient();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('recipient_name',  function ($row) {
                        return $row->first_name. " ".$row->last_name;
                })
                ->addColumn('created_at',  function ($row) {
                    return @$row->created_at;
                })
            ->make(true);
        }
     }

 
}


