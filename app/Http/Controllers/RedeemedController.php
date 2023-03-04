<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateCampaignRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\CampaignRecipient;
use App\Models\CampaignProductMapping;
use App\Models\RecipientGroup;
use App\Models\ProductImage;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\RecipientProductRedeem;
use App\Models\RecipientGroupMapping;
use App\Models\CampaignRedeemedAmount;
use App\Models\RecipientProductRedeemDetail;
use PDF;
use App\Models\Wallet;
use App\Models\Orders;
use App\Models\Client;
use Carbon\Carbon;


class RedeemedController extends Controller
{
    public function allRedeemedList(Request $request)
    {

        // dd($urlPrefix);

        $clients = Client::with('user')->orderBy('id', 'DESC')->get();
        $status_code = [
            'OP' => 'Order Placed',
            'OM' => 'Order Manifested',
            'OC' => 'Order Cancelled',
            'PP' => 'Order Picked Up',
            'OD' => 'Order Dispatched',
            'OT' => 'Order in Transit',
            'OO' => 'Order Out for Delivery',
            'NDR' => 'Failed Attempt at Delivery',
            'DL' => 'Order Delivered',
            'RTO' => 'Order Returned Back',
            'RTO-OT' => 'RTO in Transit',
            'RTO-OO' => 'RTO out for delivery',
            'RTP' => 'RTO Reached Pickrr Warehouse',
            'RTD' => 'Order Returned to Consignee',
            'error' => 'delivery_error'
        ];
        $count = 0;

        if ($request->ajax()) {
            $limit = ($request->length) ? $request->length : 10;
            $start = ($request->start) ? $request->start : 0;
            $data = RecipientProductRedeemDetail::getAllRecord($page = true);
            $dataCount = RecipientProductRedeemDetail::select('id');



            ///// Custom Search Functionality
            if ($request->search) {
                $search = $request->search;
                $data = $data->whereHas('recipientDetails', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });

                $count = $data->count();
            }
            
            $count = $data->count();
            if (!empty($request->get('client'))) {
                $data = $data->where('client_id', $request->get('client'));
                $dataCount->where('client_id', $request->get('client'));
            }

            if (!empty($request->get('staus_code'))) {
                $data = $data->where('pickrr_order_status_code', $request->get('staus_code'));
                $dataCount->where('pickrr_order_status_code', $request->get('staus_code'));
            }


            $dataCount = $dataCount->count();

            $model = $data->skip($start)->take($limit)->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    if ($row->approval_status == 0) {

                        return '<input type="checkbox" id="readme_entry_' . $row->id . '" name="readmi[]" class="readme_entry_cb" value="' . $row->id . '" />';
                    }
                })
                ->addColumn('downloadcheckbox', function ($row) {
                    if ($row->approval_status == 1) {

                        return '<input type="checkbox" id="download_redeemed_' . $row->id . '" name="downloadreedmeid[]" class="readme_entry_cb" value="' . $row->id . '" />';
                    }
                })
                // ->editColumn('description', '{!!$description!!}')
                ->addColumn('approval_status',  function ($row) {
                    return $row->approval_status == 1 ? 'Dispatched' : ($row->approval_status == 0 ? 'Pending' : 'Reject');
                })
                ->addColumn('clientName',  function ($row) {
                    return @$row['clientDetails']['client']['name'];
                })
                ->addColumn('recipientName',  function ($row) {
                    return @$row['recipientDetails']['first_name'];
                })
                ->addColumn('recipientEmail',  function ($row) {
                    return @$row['recipientDetails']['email'];
                })
                ->addColumn('productName',  function ($row) {
                    return @$row['productDetails']['name'];
                })
                ->addColumn('productPrice',  function ($row) {
                    return @$row['productDetails']['price'];
                })
                ->addColumn('company_name',  function ($row) {
                    return @$row->client->name;
                })
                ->addColumn('reedemedBudget',  function ($row) {
                    return @$row['reedemedAmount']['amount'];
                })
                ->addColumn('pickrr_order_staus',  function ($row) {
                    return (@$row['pickrr_order_status']) ? $row['pickrr_order_status'] : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return  getOptions("redeemed", $row->id, $row->approval_status);
                })
                ->editColumn('created_at',  function ($row) {
                    return getFormatedDate($row->created_at, 'd-m-Y');
                })
                ->rawColumns(['action', 'checkbox'])
                ->setOffset($start)
                ->setTotalRecords($count)
                ->make(true);
        }
        return view('redeemed-list.index', compact('clients', 'status_code'));
    }

    public function view($id)
    {
        $redeemedDetail = RecipientProductRedeemDetail::getRecordById($id);
        $image = ProductImage::getImageById($redeemedDetail->product_id);
        if (!empty($redeemedDetail)) {
            return view('redeemed-list.details', compact('redeemedDetail', 'image'));
        }
        abort(404);
    }

    public function viewOrderLablePdf($id)
    {
        $RecipientProductRedeemDetail = RecipientProductRedeemDetail::with('recipientDetails', 'clientDetails', 'orders', 'productDetails')->find($id);

        $orderresponse = json_decode($RecipientProductRedeemDetail['orders']['order_response'], true);
        $data = [
            'title' => 'Your Order Id is:' . $RecipientProductRedeemDetail['orders']['tracking_id'],
            'redeemedDetail' => $RecipientProductRedeemDetail,
            'couriar' => $orderresponse['courier'],
            'sender' => $RecipientProductRedeemDetail['clientDetails']['client']['name']
        ];

        $pdf = PDF::loadView('order-lable-pdf', $data);

        return $pdf->download($RecipientProductRedeemDetail['orders']['tracking_id'] . '.pdf');
    }

    public function placeOrder($id)
    {
        try {
            for ($i = 0; $i < 10; $i++) {
                $value = $id + $i;
                echo $value . "</br>";
                $RecipientProductRedeemDetail = RecipientProductRedeemDetail::with('recipientDetails', 'productDetails')->find($value);
                // $wallet = Wallet::where('user_id',$RecipientProductRedeemDetail->client_id)->first();
                $readme =  $RecipientProductRedeemDetail->productDetails['price'];

                $response = dispatchOrder($id, $RecipientProductRedeemDetail->productDetails, $RecipientProductRedeemDetail->recipientDetails);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function changeStatusRedeemed($id, $status)
    {
        try {
            $RecipientProductRedeemDetail = RecipientProductRedeemDetail::with('recipientDetails', 'productDetails')->find($id);

            $user_id =  \Auth::guard(getAuthGaurd())->user()->id;

            // $wallet = Wallet::where('user_id',$RecipientProductRedeemDetail->client_id)->first();
            $readme =  $RecipientProductRedeemDetail->productDetails['price'];
            // $buget = $wallet['buget'];
            // $spent =  $wallet['spentAmount'] + $readme;
            // if($buget != $readme){
            //     $gap = $wallet['pendingAmount'] - $readme;
            //     $avilableBalance =  $wallet['availableBalance'] + $gap;
            //     $pendingAmount = $wallet['pendingAmount'] - $buget;
            // }else{
            //   $avilableBalance =  $wallet['availableBalance'];
            //   $pendingAmount = $wallet['pendingAmount'];

            // }

            if ($status == 1) {
                $response = dispatchOrder($id, $RecipientProductRedeemDetail->productDetails, $RecipientProductRedeemDetail->recipientDetails);
                $dt = Carbon::now();
                $toDate =  $dt->toDateString();
                RecipientProductRedeemDetail::where('id', $id)->update([
                    'pickrr_order_status_code' => 'PP',
                    'pickrr_order_status' => 'Order Picked Up',
                    'pickrr_current_status_time' => $toDate
                ]);
            } else {
                $response = 1;
                RecipientProductRedeemDetail::where('id', $id)->update([
                    'pickrr_order_status_code' => 'RR',
                    'pickrr_order_status' => 'Rejected',
                ]);
            }



            // $wres = Wallet::where('user_id',$RecipientProductRedeemDetail->client_id)->update([
            //     'availableBalance' => $avilableBalance,
            //     'pendingAmount' =>  $pendingAmount,
            //     'spentAmount' => $spent
            // ]);

            if ($response != 1) {
                return response()->json([
                    'success' => false,
                    'message' => $response, // "Something went wrong!"
                ], 200);
            } else {
                $status = RecipientProductRedeemDetail::toggleStatusById($id, $status);
                if ($status == 1) {
                    return response()->json([
                        'success' => true,
                        'message' => config('constants.CAMPAIGN_STATUS')
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => config('constants.SOMETHING_WENT_WRONG')
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function cancelOrder($id)
    {
        $order = Orders::pluck('tracking_id')->take(10)->toArray();
        foreach ($order as $value) {
            cancelOrder($value);
        }
        // cancelOrder($id);

    }

    public function dispatchAllAutomatically($id)
    {
        try {
            $status = 1;
            $allRecipientProductRedeemsArr = RecipientProductRedeemDetail::where('campaign_id', $id)->get();

            if (count($allRecipientProductRedeemsArr)) {
                foreach ($allRecipientProductRedeemsArr as $data) {

                    $RecipientProductRedeemDetail = RecipientProductRedeemDetail::with('recipientDetails', 'productDetails')->find($data->id);

                    if (!empty($RecipientProductRedeemDetail)) {
                        $response = dispatchOrder($RecipientProductRedeemDetail->id, $RecipientProductRedeemDetail->productDetails, $RecipientProductRedeemDetail->recipientDetails);

                        $status = RecipientProductRedeemDetail::toggleStatusById($data->id, $status);
                    }
                }
            }
        } catch (Exception $e) {
        }
    }

    public function multipleDispatch(Request $request)
    {
        $ids = $request->input('ids');
        foreach ($ids as $value) {
            $RecipientProductRedeemDetail = RecipientProductRedeemDetail::with('recipientDetails', 'productDetails')->find($value);
            if ($request->status == 1) {
                $response = dispatchOrder($value, $RecipientProductRedeemDetail->productDetails, $RecipientProductRedeemDetail->recipientDetails);
                $dt = Carbon::now();
                $toDate =  $dt->toDateString();
                if ($response == 1) {
                    RecipientProductRedeemDetail::where('id', $value)->update([
                        'pickrr_order_status_code' => 'PP',
                        'pickrr_order_status' => 'Order Picked Up',
                        'pickrr_current_status_time' => $toDate
                    ]);
                    $status = RecipientProductRedeemDetail::toggleStatusById($value, $request->status);
                }
            } else {
                RecipientProductRedeemDetail::where('id', $id)->update([
                    'pickrr_order_status_code' => 'RR',
                    'pickrr_order_status' => 'Rejected',
                ]);
                $status = RecipientProductRedeemDetail::toggleStatusById($value, $request->status);
            }
        }
        return response()->json([
            'success' => true,
            'message' => config('constants.CAMPAIGN_STATUS')
        ], 200);
    }
}
