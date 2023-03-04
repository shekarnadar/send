<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateCampaignRequest;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\CampaignRecipient;
use App\Models\CampaignProductMapping;

class CampaignController extends Controller
{
    
    public function allCampaignList(Request $request){
        if($request->ajax()){
            $data = Campaign::getAllCampaign();
           
            return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('description', '{!!$description!!}')
                        ->editColumn('approval_status', '{{$approval_status ? "Approved" : "Pending"}}')
                        ->addColumn('created_by_user',  function ($row) {
                            return $row->user->first_name. " ".$row->user->last_name;
                        })
                        ->addColumn('action', function ($row) {
                            $record = "";
                            if($row->is_active == 1){
                                $record .= '<button class="btn btn-danger"  onClick="statusData('.$row->id.')">Deactivate </button>';
                            }else{
                                $record .= '<button class="btn btn-success"  onClick="statusData('.$row->id.')">Activate </button>';
                            }

                            $urlPrefix = '';
                            if(getAuthGaurd() == 'super_admin'){
                                $urlPrefix = 'super-admin'; 
                            } else if(getAuthGaurd() == 'client_admin'){
                                $urlPrefix = 'client-admin'; 
                            }
                            $viewAction = url($urlPrefix."/view-campaign", $row->id);
                            $editAction = url($urlPrefix."/edit-campaign", $row->id);
                            $record .= ' <a href="'.$viewAction.'" class="btn btn-default">View</a>';
                            $record .= ' <a href="'.$editAction.'" class="btn btn-default">Edit</a>';
                            return $record;
                        })                     
             ->rawColumns(['action', 'description','created_by_user'])
            ->make(true);
        }
        return view('campaigns.index'); 
    }

    public function view($id){
        $campaign = Campaign::getDetailById($id);
        if(!empty($campaign)){
            return view('campaigns.details',compact('campaign'));
        }
        abort(404);
    }

    

    public function add(){
        //  dd('great');
        if(getAuthGaurd() == 'client_admin') {
            dd('great');
            return view('campaigns.add-edit');
        }
        abort(404);
    }

    public function sendList(Request $request){
        $prevFormData = $request->all();
        $recipients = Recipient::getAll(null);
        if(getAuthGaurd() == 'client_admin') {
            return view('campaigns.send-list', compact('prevFormData','recipients'));
        }
        abort(404);
    }

    public function sendOption(Request $request){
        $prevFormData = $request->all();
        $prevFormData['recipient_id']= implode(',',$prevFormData['recipient_id']);

        if(getAuthGaurd() == 'super_admin') {
            return view('super-admin.campaigns.send-option'); 
        } else {
            return view('client-admin.campaigns.send-option',compact('prevFormData'));
        }
        abort(404);
    }

    public function saveCampaignFinalStep(Request $request){
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
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

    public function listname(){
        return view('super-admin.recipients.list-name',);
    }

    public function Addlistname(){
        return view('super-admin.recipients.add-list-name',);
    }

    public function Upload(){
        return view('super-admin.recipients.upload-recipient',);
    }


    public function edit($id){
        $campaign = Campaign::getDetailById($id);

        if(!empty($campaign)){
            return view('super-admin.campaigns.add-edit',compact('campaign'));
        }

        abort(404);
    }

    public function save(AddUpdateCampaignRequest $request)
    {
        try {
            Campaign::saveProduct($request->all());

            return response()->json(['success' => true,
                'message' => config('constants.CAMPAIGN_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }  
    }

    public function delete($id)
    {
        try {
            Campaign::deleteById($id);

                return response()->json(['success' => true,
                    'message' => config('constants.CAMPAIGN_DELETED_SUCCESS')
                ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }  
    }

    function showProducts(Request $request) {
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;

        $q = Product::select('*');
        $q->where('created_by_user_id', 16);
        $q->where('is_deleted', 0);        
        $q->whereBetween('price', [$minPrice, $maxPrice]);
        $data = $q->get(); 

       
        //print_r($data);
        $productsHtml = '';
        if(!empty($data)) {
            foreach($data as $pro) {
                $productsHtml .= '
                <div class="list-item col-md-3">
                    <div class="card o-hidden mb-4 d-flex flex-column">
                        <div class="list-thumb d-flex">
                            <img alt="" src="http://gull-html-laravel.ui-lib.com/assets/images/products/speaker-1.jpg" />
                        </div>
                        <div class="flex-grow-1 d-bock">
                            <div
                                class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                                <a class="w-40 w-sm-100" href="javascript:void(0)">
                                    <div class="item-title">
                                    '.$pro->name.'
                                    </div>
                                </a>
                                <p class="m-0 text-muted text-small w-15 w-sm-100">
                                    ₹'.$pro->price.'
                                </p>
                                <p>
                                <input type="checkbox" class="addPro" value='.$pro->id.' onclick="addProduct('.$pro->id.',this)">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            
     
    } 
    echo $productsHtml;
    }

    // view campaign recipients
    public function campaignRecipientsList(Request $request) {
       if($request->ajax()){
        //$data =  CampaignRecipient::campaignRecipientsList($request->all());
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('redeem_link', '{{url($redeem_link)}}')
                     ->addColumn('created_by_user',  function ($row) {
                     return $row->recipient->first_name. " ".$row->recipient->last_name;
                     })
                     ->addColumn('email',  function ($row) {
                        return $row->recipient->email;
                        })
                    ->addColumn('action', function ($row) {
                        $record = "";
                        $urlPrefix = '';
                        if(getAuthGaurd() == 'super_admin'){
                            $urlPrefix = 'super-admin'; 
                        } else if(getAuthGaurd() == 'client_admin'){
                            $urlPrefix = 'client-admin'; 
                        }
                        $viewAction = url($urlPrefix."/view-campaign", $row->id);
                        $editAction = url($urlPrefix."/edit-campaign", $row->id);
                        $record .= ' <a href="'.$viewAction.'" class="btn btn-default">View</a>';
                        return $record;
                    })                     
         ->rawColumns(['action', 'description','created_by_user'])
        ->make(true);
        }
    }

    // Campaign recipient product list
    public function campaignRecipientsProductsList(Request $request) {
        if($request->ajax()){
         $data =  CampaignProductMapping::campaignRecipientsProductsList($request->all());
         return DataTables::of($data)
                     ->addIndexColumn()
                      ->addColumn('product_name',  function ($row) {
                      return $row->product->name;
                      })
                    ->addColumn('product_description',  function ($row) {
                    return $row->product->description;
                    })
                    ->addColumn('product_price',  function ($row) {
                    return $row->product->price;
                    })
                    ->addColumn('product_code',  function ($row) {
                        return $row->product->code;
                        })
                     ->addColumn('action', function ($row) {
                         $record = "";
                         $urlPrefix = '';
                         if(getAuthGaurd() == 'super_admin'){
                             $urlPrefix = 'super-admin'; 
                         } else if(getAuthGaurd() == 'client_admin'){
                             $urlPrefix = 'client-admin'; 
                         }
                         $viewAction = url($urlPrefix."/view-campaign", $row->id);
                         $editAction = url($urlPrefix."/edit-campaign", $row->id);
                         $record .= ' <a href="'.$viewAction.'" class="btn btn-default">View</a>';
                         return $record;
                     })                     
          ->rawColumns(['action', 'product_name','product_description','product_price'])
         ->make(true);
        }
    }

    public function redeemProductDetails($link){
        $data = CampaignRecipient::getDetailsByRedeemLink($link);
        // echo '<pre>';
        // print_r($data);
        // exit;

       $campaign_id = $data['campaign_id'];
       
       $campaignDetails = Campaign::getDetailById($campaign_id);
       $post['id'] = $campaign_id;
       $campaignRecipients = CampaignRecipient::campaignRecipientsList($post);
       $productsList =  CampaignProductMapping::campaignRecipientsProductsList($post);
       // dd($campaignRecipients);
        // echo '<pre>';
        // print_r($campaignRecipients);
        // exit;

        if(!empty($data)){
            return view('redeem.details', compact('campaignDetails','campaignRecipients','productsList','link'));
        }

        abort(404);
    }


    public function redeemProductCheckout($link){
        $data = CampaignRecipient::getDetailsByRedeemLink($link);
        // echo '<pre>';
        // print_r($data);
        // exit;

       $campaign_id = $data['campaign_id'];
       
       $campaignDetails = Campaign::getDetailById($campaign_id);
       $post['id'] = $campaign_id;
       $campaignRecipients = CampaignRecipient::campaignRecipientsList($post);
       $productsList =  CampaignProductMapping::campaignRecipientsProductsList($post);
       // dd($campaignRecipients);
        // echo '<pre>';
        // print_r($campaignRecipients);
        // exit;

        if(!empty($data)){
            return view('redeem.checkout', compact('campaignDetails','campaignRecipients','productsList','link'));
        }

        abort(404);
    }

    public function viewRedeemDetails($link)
    {
        $data = CampaignRecipient::getDetailsByRedeemLink($link);
        // echo '<pre>';
        // print_r($data);
        // exit;
        
       $campaign_id = $data['campaign_id'];
       $campaignDetails = Campaign::getDetailById($campaign_id);
       $post['id'] = $campaign_id;
       $campaignRecipients = CampaignRecipient::campaignRecipientsList($post);
       $productsList =  CampaignProductMapping::campaignRecipientsProductsList($post);
       // dd($campaignRecipients);
        // echo '<pre>';
        // print_r($campaignRecipients);
        // exit;

        if(!empty($data)){
            return view('redeem.redeem-gift-details', compact('campaignDetails','campaignRecipients','productsList','link'));
        }

        abort(404);
    }


}

