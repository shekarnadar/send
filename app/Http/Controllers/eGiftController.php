<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignProductMapping;
use App\Models\CampaignRecipient;
use App\Models\Client;
use App\Models\MessageTemplate;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\RecipientGroup;
use App\Models\RecipientGroupMapping;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class eGiftController extends Controller
{
    public function alleCampaignList(Request $request)
    {
        if ($request->ajax()) {
            $data = Campaign::where('type', 'egift')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('description', '{!!$description!!}')
                ->editColumn('approval_status', '{{$approval_status ? "Approved" : "Pending"}}')
                ->addColumn('created_by_user',  function ($row) {
                    return $row->user->first_name . " " . $row->user->last_name;
                })
                ->addColumn('action', function ($row) {
                    $record = "";
                    if ($row->is_active == 1) {
                        $record .= '<button class="btn btn-danger"  onClick="statusData(' . $row->id . ')">Deactivate </button>';
                    } else {
                        $record .= '<button class="btn btn-success"  onClick="statusData(' . $row->id . ')">Activate </button>';
                    }

                    $urlPrefix = '';
                    if (getAuthGaurd() == 'super_admin') {
                        $urlPrefix = 'super-admin';
                    } else if (getAuthGaurd() == 'client_admin') {
                        $urlPrefix = 'client-admin';
                    }
                    $viewAction = url($urlPrefix . "/view-campaign", $row->id);
                    $editAction = url($urlPrefix . "/edit-campaign", $row->id);
                    $record .= ' <a href="' . $viewAction . '" class="btn btn-default">View</a>';
                    $record .= ' <a href="' . $editAction . '" class="btn btn-default">Edit</a>';
                    return $record;
                })
                ->rawColumns(['action', 'description', 'created_by_user'])
                ->make(true);
        }
        return view('egift.index');
    }

    public function add(Request $request)
    {
        //    dd($request->all());

        if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
            $userId = \Auth::guard(getAuthGaurd())->user()->id;
            $wallet = Wallet::where('user_id', $userId)->first();
            $walletAmount = isset($wallet->amount) ? $wallet->amount : 0;
            $availableBalance = (@$wallet->availableBalance == 0) ? $walletAmount : $wallet->availableBalance;
            // $walletAmount = isset($wallet->amount) ? $wallet->amount : 0;
            // $maximumBudget = Campaign::where('created_by_user_id',$userId)->sum('budget');
            // //add by anmol
            // $newpendingAmount = $maximumBudget;
            // $redeemAmount = CampaignRedeemedAmount::where('client_id',$userId)->sum('amount');
            // $spentAmount = isset($redeemAmount) ? $redeemAmount : 0;
            // $pendingAmount = $newpendingAmount - $redeemAmount;
            // $availableBalance = $walletAmount -  $newpendingAmount + $pendingAmount;
            // $pendingAmount = $pendingAmount -$pendingAmount;
            $availableBalance = 0; // ($wallet->availableBalance == 0) ? $walletAmount : $wallet->availableBalance;
            return view('egift.step-1', compact('availableBalance'));
        }
        abort(404);
    }

    public function step2(Request $request)
    {
        $prevFormData = $request->all();
        $recipients = Recipient::getAll(null, true);
        $recipientGroup = RecipientGroup::getActiveGroups();

        /*************check for campaign  Available Amount**************/
        $productMaxPrice =  Product::maxPriceOfProducts($request->product_ids);
        $userId = \Auth::guard(getAuthGaurd())->user()->id;
        $wallet = Wallet::where('user_id', $userId)->first();
        $availableBalance = 0; // ($wallet['availableBalance'] == 0 ) ? $wallet->amount : $wallet['availableBalance']; 
        // $walletAmount = isset($wallet->amount) ? $wallet->amount : 0;
        // $maximumBudget = Campaign::where('created_by_user_id',$userId)->sum('budget');
        // //add by anmol
        // $newpendingAmount = $maximumBudget;
        // $redeemAmount = CampaignRedeemedAmount::where('client_id',$userId)->sum('amount');
        // $spentAmount = isset($redeemAmount) ? $redeemAmount : 0;
        // $pendingAmount = $newpendingAmount - $redeemAmount;
        // $availableBalance = $walletAmount -  $newpendingAmount + $pendingAmount;
        // $pendingAmount = $pendingAmount -$pendingAmount;

        if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
            return view('egift.step-2', compact('prevFormData', 'recipients', 'recipientGroup', 'availableBalance', 'productMaxPrice'));
        }
        abort(404);
    }

    public function step3(Request $request)
    {
        $userId = \Auth::guard(getAuthGaurd())->user()->client_id;
        $client = Client::select('url', 'token')->where('id', $userId)->first();
        $data['url'] = $client['url'];
        $data['token'] = $client['token'];

        $whatsappTemplate = getTemplate($data);
        if ($whatsappTemplate == 0) {
            $whatsappData = false;
        } else {
            $whatsappData = true;
        }
        //$explode = explode(',',$request->recipient_id);
        $explode = explode(',', $request->recipient_id);

        // if(!empty($request->recipient_id)){
        //     $recpCount = Recipient::whereIn('id', $explode)->get();
        // }

        $recpCount = count($explode);
        $data = explode(",", $request->product_ids);
        $newdata = Product::whereIn('id', $data)->get();
        $productMaxPrice = collect($newdata)->flatten()->max('price');
        $group = RecipientGroupMapping::groupDetails($request->group_id);

        if (!empty($recpCount)) {
            $budget =  $recpCount * $productMaxPrice;
        } else {
            $budget =  $group->count() * $productMaxPrice;
        }

        $prevFormData = $request->all();

        if ($prevFormData['recipient_type'] == 'individual') {
            $prevFormData['recipient_id'] = $prevFormData['recipient_id'];
        }
        $templates = MessageTemplate::getDetails();

        if (getAuthGaurd() == 'super_admin') {
            return view('super-admin.campaigns.step-3');
        } else {
            return view('egift.step-3', compact('prevFormData', 'templates', 'budget', 'productMaxPrice', 'whatsappTemplate', 'whatsappData'));
        }
        abort(404);
    }


   public function showProducts(Request $request) {

        
            $path = storage_path().'\app\public\data.json';
            $json = json_decode(file_get_contents($path), true); 
            // $data = Product::where('type', $request->type)->get();
            
            $productsHtml='';

            foreach($json['products'] as $j){
            $productsHtml .= '
            <div class="list-item col-md-3">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                      <img alt="" src="'.$j["images"]["thumbnail"] .'"/>
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="javascript:void(0)">
                                <div class="item-title">
                                '.$j['name'].'
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                ₹'.$j['currency']['numericCode'].'
                            </p>
                            <p>
                            <input type="checkbox" class="addPro" value='.$j['sku'].' onclick="addProduct(1,this)">
                            </p>
                        </div>
                    </div>
                </div>

            </div>';
            } 

        echo $productsHtml;
        
     
    }


    public function saveCampaignFinalStep(Request $request){
        if($request->input('email')){
            $validated = $request->validate([
                'subject' => 'required'
            ]);
 
        }
        \DB::beginTransaction();
        try {
            $post = $request->all();
           
            $campData = Campaign::saveCampaign($post);
            $post['campaign_id'] = $campData->id;

            CampaignRecipient::saveCampaignRecipient($post);

            CampaignProductMapping::saveCampaignProduct($post);

            \DB::commit();

            return response()->json(['success' => true,
                'message' => config('constants.CAMPAIGN_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            \DB::rollBack();
            return response()->json(['success' => false,
                'message' => $e->getMessage()  //config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    
}
