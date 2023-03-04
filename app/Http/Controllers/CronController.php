<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use App\Models\Log;
use App\Models\ShortUrl;

use App\Models\Orders;
use App\Models\CampaignRecipient;

use Yajra\DataTables\Facades\DataTables;
use App\Exports\ExportOrders;
use App\Models\RecipientProductRedeemDetail;
use App\Models\Pagignation;
use App\Http\Controllers\QwikCilverController;
use App\Models\CronLog;
use App\Models\EProductCategory;
use App\Models\EProduct;

class CronController extends Controller
{
    public function changeshortUrl()
    {
        $result = CampaignRecipient::get()->toArray();

        foreach ($result as $value) {
            $urlkey = genrateShortLink(url($value['redeem_link']));
            CampaignRecipient::where('redeem_link', $value['redeem_link'])->update(['urlkey' => $urlkey]);
        }
    }

    public function sendReadmeNotification()
    {
        \Log::channel('cronLog')->info('## Send notification cron.');

        $result = CampaignRecipient::with(['recipient', 'campaign'])->whereDate('created_at', Carbon::now()->subDays(2))->where('is_readme', 0)->get();

        foreach ($result as $value) {

            $sendMessage['phone'] = $value->recipient->phone;
            $sendMessage['redeem_link'] = $value['redeem_link'];
            $sendMessage['name'] = ucwords($value->recipient->first_name . ' ' . $value->recipient->last_name);
            $sendMessage['client_user_id'] = $value->recipient->invited_by_user_id;
            $sendMessage['recipient_id'] = $value->recipient->id;
            // sendWhatsappMessage($sendMessage);

            $emailData['request'] = 'send_redeem_gift_link_mail';
            $emailData['name'] = ucwords($value->recipient->first_name . ' ' . $value->recipient->last_name);
            $emailData['email'] = trim($value->recipient->email);
            $emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
            $emailData['subject'] = 'Happy Diwali From Ek Matra (You have received a Gift)';
            $emailData['redeem_link'] = url($value->redeem_link);
            $emailData['client_user_id'] = $value->recipient->invited_by_user_id;
            $emailData['recipient_id'] = $value->id;
            $emailData['campaign_id'] = $value->campaign_id;
            $emailData['client_name'] = $value->campaign->clientDetail->name;
            $description  = $value->campaign->description;
            $emailData['email_description'] = emilDescription($value->campaign->template_id, $value->recipient->first_name, $value->campaign->clientDetail->name, $value->recipient->last_name, $value->campaign->description);
            if (!empty($value->recipient->emailSettingInfo)) {
                $clientSettingEmail = $value->recipient->emailSettingInfo->email;
                $clientSettingPassword = $value->recipient->emailSettingInfo->password;
                setEmailConfig($clientSettingEmail, $clientSettingPassword);
            }
            dispatch(new SendEmailJob($emailData));
        }
    }
    public function sendBulkCampaignRedeemLinkEmail()
    {
        \Log::channel('cronLog')->info('## Send Bulk Campaign Redeem Link Email.');
        /*
            Case :  (Bulk)
             daily at certaing fix time :

                    will run at campaign date (start_date) from database
                    if(start_date === today_date)
                        then send mail to recipients for redeem link
        */

        $campaigns = Campaign::getAllActiveCampaign('bulk');
        $campName = '';
        // \Log::info($campaigns);
        if (count($campaigns) > 0) {
            foreach ($campaigns as $camp) {

                // // cron log
                // $campName .= '\n '.$camp->name;
                // \Log::channel('cronLog')->info("Bulk campaign ::".$campName);
                $cron_log = CronLog::where('campaign_id', $campaigns->id)
                    ->whereDate('created_at', '>=', Carbon::today())
                    ->first();

                if (!empty($cron_log))
                    continue;
                else {
                    $recipients = $camp->campaignRecipient;
                    if (count($recipients) > 0) {
                        foreach ($recipients as $recep) {
                            $this->sendMailToRecip($recep, $camp);
                        }
                    }
                }
            }
        }
    }

    public function sendIndividualCampaignRedeemLinkEmail()
    {
        \Log::channel('cronLog')->info('## Send Individual Campaign Redeem Link Email.');

        /*
        *
            Case : (Individual)
             daily at certaing fix time :

             end_date should not passed or campaign valid until end_date

                if (end_date >= current date)

                    then
                       bases on select type :
                            fetch details of aniversary or birthday date

                            send email to recipients before_days count from campaign table
        */

        $campaigns = Campaign::getAllActiveCampaign('individual');
        $campName = '';

        if (count($campaigns) > 0) {
            foreach ($campaigns as $camp) {

                if ($camp->clientDetail->is_active == '1') {
                    $recipients = $camp->campaignRecipient;

                    // cron log
                    // $campName .= '\n '.$camp->name;
                    // \Log::channel('cronLog')->info("Individual campaign ::".$campName);

                    if (count($recipients) > 0) {

                        foreach ($recipients as $recep) {
                            $currentDate = date('m-d');
                            $beforeDay = !empty($camp->before_days) ? $camp->before_days : 0;
                            if (!empty($recep->recipient->date_of_birth) && $camp->event_type == "birthday") {

                                $beforeDays = Carbon::parse($recep->recipient->date_of_birth)->subDay($beforeDay)->format('m-d');

                                if ($beforeDays == $currentDate) {
                                    $this->sendMailToRecip($recep, $camp);
                                    // echo "beforeDays ==>".$beforeDays." currentDate ===>".$currentDate;
                                }
                            }

                            if (!empty($recep->recipient->date_of_anniversary) && $camp->event_type == "anniversary") {
                                $beforeDays = Carbon::parse($recep->recipient->date_of_anniversary)->subDay($beforeDay)->format('m-d');

                                if ($beforeDays == $currentDate) {
                                    $this->sendMailToRecip($recep, $camp);
                                    echo "beforeDays ==>" . $beforeDays . " anniversary ===>" . $currentDate;
                                }
                            }

                            // CHECK FOR DATE1  STARTS
                            if (!empty($recep->recipient->date_1) && $camp->event_type == "date1") {
                                $beforeDays = Carbon::parse($recep->recipient->date_1)->subDay($beforeDay)->format('m-d');

                                if ($beforeDays == $currentDate) {
                                    $this->sendMailToRecip($recep, $camp);
                                }
                            }
                            // CHECK FOR DATE1 ENDS

                            // CHECK FOR DATE2  STARTS
                            if (!empty($recep->recipient->date_2) && $camp->event_type == "date2") {
                                $beforeDays = Carbon::parse($recep->recipient->date_2)->subDay($beforeDay)->format('m-d');

                                if ($beforeDays == $currentDate) {

                                    $this->sendMailToRecip($recep, $camp);
                                }
                            }
                            // CHECK FOR DATE2 ENDS

                            // CHECK FOR DATE3  STARTS
                            if (!empty($recep->recipient->date_3) && $camp->event_type == "date3") {
                                $beforeDays = Carbon::parse($recep->recipient->date_3)->subDay($beforeDay)->format('m-d');

                                if ($beforeDays == $currentDate) {
                                    $this->sendMailToRecip($recep, $camp);
                                }
                            }
                            // CHECK FOR DATE3 ENDS
                        }
                    }
                }
            }
        }
    }

    public function sendMailToRecip($recep, $camp)
    {
        if ($recep->recipient->is_active == '1' && $recep->recipient->is_deleted == '0') {
            echo $recep->recipient->id;
            echo "================== <br>";

            if ($camp->is_mail == 1) {
                try {
                    $emailData['request'] = 'send_redeem_gift_link_mail';
                    $emailData['name'] = ucwords($recep->recipient->first_name . ' ' . $recep->recipient->last_name);
                    $emailData['email'] = trim($recep->recipient->email);
                    $emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
                    $emailData['subject'] = 'Happy Diwali From Ek Matra (You have received a Gift)';
                    $emailData['client_name'] = $camp->clientDetail->name;
                    $emailData['redeem_link'] = url($recep->redeem_link);

                    $emailData['client_user_id'] = $camp->created_by_user_id;
                    $emailData['recipient_id'] = $recep->recipient_id;
                    $emailData['campaign_id'] = $camp->id;

                    $description  = $camp->description;
                    if ($camp->template_id == 1) {
                        $words = ["{{FIRST_NAME}}", "{{CLIENT_NAME}}"];
                        $replaceWords   = [$recep->recipient->first_name, $camp->clientDetail->name];
                        $newPhrase = str_replace($words, $replaceWords, $description);
                        $emailData['email_descrip   tion'] = $newPhrase;
                    } else if ($camp->template_id == 2) {
                        $words = ["{{FIRST_NAME}}", "{{LAST_NAME}}"];
                        $replaceWords   = [$recep->recipient->first_name, $recep->recipient->last_name];
                        $newPhrase = str_replace($words, $replaceWords, $description);
                        $emailData['email_description'] = $newPhrase;
                    } else {
                        $emailData['email_description'] = $camp->description;
                    }

                    // if(!empty($camp->emailSettingInfo)){
                    //     $clientSettingEmail = $camp->emailSettingInfo->email;
                    //     $clientSettingPassword = $camp->emailSettingInfo->password;
                    //     setEmailConfig($clientSettingEmail, $clientSettingPassword);
                    // }

                    \Log::channel('cronLog')->info('Campgain name ::' . $camp->name . ",Recipient email ::" . $recep->recipient->email . ", Status :: success");

                    $save_cron_data = array(
                        'cron_type' => $camp->type,
                        'campaign_id' => $camp->id,
                        'is_crone_executed' => 1,
                        'status' => 'success',
                    );
                    CronLog::saveCronLog($save_cron_data);

                    return dispatch(new SendEmailJob($emailData));
                } catch (\Exception $e) {

                    $save_cron_data = array(
                        'cron_type' => $camp->type,
                        'campaign_id' => $camp->id,
                        'is_crone_executed' => 1,
                        'status' => 'failed',
                    );
                    CronLog::saveCronLog($save_cron_data);

                    $emailData['medium'] = 'email';
                    $emailData['description'] = $e->getMessage();
                    $emailData['status'] = false;

                    \Log::channel('cronLog')->info('Campgain name ::' . $camp->name . ",Recipient email ::" . $recep->recipient->email . ", Status :: failed, Error ::" . $e->getMessage());
                    Log::saveLog($emailData);
                }
            }

            if ($camp->is_whatsapp == 1) {
                $sendMessage['phone'] = $recep->recipient->phone;
                $sendMessage['redeem_link'] = url($recep->redeem_link);
                $sendMessage['name'] = ucwords($recep->recipient->first_name . ' ' . $recep->recipient->last_name);
                $sendMessage['client_user_id'] =  $camp->created_by_user_id;
                $sendMessage['recipient_id'] = $recep->recipient_id;
                $sendMessage['campaign_id'] = $camp->id;
                sendWhatsappMessage($sendMessage);
            }
        }
    }

    //logs view
    public function alllogsList(Request $request)
    {
        // dd('Great');

        // $data = Log::getAllLog($page = true);
        // $model = $data->get();
        // dd($model)

        // dd($model[0]['clientInfo']['client']['name']);

        // if ($request->get('search')) {
        //     $search = $request->get('search');
        //     $data->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%')->orWhere('price', 'like', '%' . $search . '%');
        // }
        // $search = 'Shudhanshu';
        // $data = $data->whereHas('recipientInfo', function ($query) use ($search) {
        //     $query->where('first_name', 'like', '%' . $search . '%');
        // })
        //     ->with(['recipientInfo' => function ($query) use ($search) {
        //         $query->where('first_name', 'like', '%' . $search . '%');
        //     }])->get();

        // dd($data[0]['recipientInfo']['first_name']);


        $count = 0;

        if ($request->ajax()) {
            $limit = ($request->length) ? $request->length : 10;
            $start = ($request->start) ? $request->start : 0;
            $data = Log::getAllLog($page = true);


            ///// Custom Search Functionality
            if ($request->search) {
                $search = $request->search;
                $data = $data->whereHas('recipientInfo', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });

                $count = $data->count();
            }

            $count = $data->count();
            $model = $data->skip($start)->take($limit)->get();

            $datatable = DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('recipientDetail',  function ($row) {
                    return !empty($row['recipientInfo']) ? $row['recipientInfo']['first_name'] . " " . $row['recipientInfo']['last_name'] : 'Unknown ';
                })
                ->addColumn('campaign', function ($row) {
                    return !empty($row['campaignInfo']) ? $row['campaignInfo']['name'] : 'N/A';
                })
                ->addColumn('phone',  function ($row) {
                    return !empty($row['recipientInfo']) ? $row['recipientInfo']['phone'] : 'Unknown ';
                })
                ->addColumn('email',  function ($row) {
                    return !empty($row['recipientInfo']) ? $row['recipientInfo']['email'] : 'Unknown ';
                })
                ->addColumn('group_name', function ($row) {
                    return count(@$row['recipientInfo']['recipientGroups']) > 0 ? groupsNames(@$row['recipientInfo']['recipientGroups']) : '';
                })
                ->addColumn('campaignDetail',  function ($row) {
                    return !empty($row['campaignInfo']) ? $row['campaignInfo']['name'] : '';
                })
                ->addColumn('open_count',  function ($row) {
                    return !empty($row['open_count']) ? $row['open_count'] : 0;
                })
                ->addColumn('link_count',  function ($row) {
                    return !empty($row['link_count']) ? $row['link_count'] : 0;
                })
                ->editColumn('created_at',  function ($row) {
                    return getFormatedDate($row->created_at, 'd-m-Y');
                })
                ->addColumn('status',  function ($row) {
                    return $row->status == 1 ? 'Sent' : 'Fail';
                });

            if (getAuthGaurd() != 'client_admin') {
                $datatable->addColumn('clientName',  function ($row) {
                    return !empty($row['clientInfo']['client']) ? $row['clientInfo']['client']['name'] : 'NA';
                });
            }

            return $datatable->setOffset($start)
                ->setTotalRecords($count)
                ->make(true);
        }
        return view('logs.index');
    }

    public function orderlogsList(Request $request)
    {
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

        //         $data = Orders::getAllLog($page = true);

        // $model = $data->get();
        // dd($model[0]['recipientReedme']['clientDetails']['client']['name']);


        if ($request->ajax()) {
            $limit = ($request->length) ? $request->length : 10;
            $start = ($request->start) ? $request->start : 0;
            // $dataCount = Orders::select('id');
            $data = Orders::getAllLog($page = true);

            ///// Custom Search Functionality
            if ($request->search) {
                $search = $request->search;
                $data = $data->whereHas('recipientReedme.recipientDetails', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });

                $count = $data->count();
            }

            if (!empty($request->get('staus_code'))) {
                $value = $request->get('staus_code');
                $data = $data->whereHas('recipientReedme', function ($q) use ($value) {
                    $q->where('pickrr_order_status_code', '=', $value); // '=' is optional
                });
                // $dataCount->where('recipient_product_redeem_details.pickrr_order_status_code',$request->get('staus_code'));
            }

            $dataCount = $data->count();
            $model = $data->skip($start)->take($limit)->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('recipientDetail',  function ($row) {
                    return !empty($row['recipientReedme']['recipientDetails']) ? $row['recipientReedme']['recipientDetails']['first_name'] . " " . $row['recipientReedme']['recipientDetails']['last_name'] : 'Unknown ';
                })
                ->addColumn('phone',  function ($row) {
                    return !empty($row['recipientReedme']['recipientDetails']) ? $row['recipientReedme']['recipientDetails']['phone'] : 'Unknown ';
                })
                ->addColumn('email',  function ($row) {
                    return !empty($row['recipientReedme']['recipientDetails']) ? $row['recipientReedme']['recipientDetails']['email'] : 'Unknown ';
                })
                ->addColumn('product_name',  function ($row) {
                    return !empty($row['recipientReedme']['productDetails']) ? $row['recipientReedme']['productDetails']['name'] : 'Unknown ';
                })
                ->addColumn('group_name', function ($row) {
                    return count(@$row['recipientReedme']['recipientDetails']['recipientGroups']) > 0 ? groupsNames(@$row['recipientReedme']['recipientDetails']['recipientGroups']) : '';
                })
                ->addColumn('tracklink',  function ($row) {
                    $urlPrefix = '';
                    if (getAuthGaurd() == 'super_admin') {
                        $urlPrefix = 'super-admin';
                    } else if (getAuthGaurd() == 'client_admin') {
                        $urlPrefix = 'client-admin';
                    }
                    $action = url($urlPrefix . '/trackorder/' . $row->tracking_id);
                    $record = '<a target="_blank" href="' . $action . '" class="btn btn-primary">Track</a>';
                    return $record;
                })
                ->editColumn('created_at',  function ($row) {
                    return getFormatedDate($row->created_at, 'd-m-Y');
                })
                ->addColumn('courier',  function ($row) {
                    $data = json_decode($row->order_response, true);
                    return $data['courier']; 
                })
                ->addColumn('status',  function ($row) {
                    return @$row['recipientReedme']['pickrr_order_status'] ? $row['recipientReedme']['pickrr_order_status'] : 'N/A';
                })
                ->addColumn('clientName',  function ($row) {
                    return @$row['recipientReedme']['clientDetails']['client'] ? $row['recipientReedme']['clientDetails']['client']['name'] : 'N/A';
                })

                ->rawColumns(['tracklink'])
                ->setOffset($start)
                ->setTotalRecords($dataCount)
                ->make(true);
        }

        $data = Orders::getAllLog($page = true)->get();
        // dd($data[0]->recipientReedme->campaignDetails);
        $totalGiftRedeemedCount = Campaign::totalGiftRedeemedCount();

        return view('orders.index', compact('status_code', 'data','totalGiftRedeemedCount'));
    }

    public function exportOrder(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        return \Excel::download(new ExportOrders($start_date, $end_date), 'Orders.xlsx');
    }
    public function trackOrder($id)
    {
        $response = trackingOrderStatus($id);

        if ($response['err']) {
            $err = $response['err'];

            return view('orders.trackOrder', compact('err'));
        } else {
            $err = '';
            $order = Orders::with('recipientReedme')->where('tracking_id', $id)->first();
            $recipent = $order->recipientReedme->recipientDetails;
            $clientDetail = $order->recipientReedme->clientDetails->client;
            $client = $response['info'];
            $product = $response['item_list'][0];
            $track_arr = $response['track_arr'];
            $courier_used = $response['courier_used'];
            $company_name = $response['company_name'];
            return view('orders.trackOrder', compact('client', 'product', 'track_arr', 'company_name', 'recipent', 'clientDetail', 'courier_used'));
        }
    }

    // function for check is order is delivered or not from pickker database
    public function orderStatusChangeIfDelivered()
    {
        $pageCount =  Pagignation::whereDate("created_at", "=", date("Y-m-d", time()))->first();

        // get all redeemed and dispacted product

        /**
         * approval_status = 1  => dispached
         * is_completed = 0 => is not delivered
         */
        $count =  RecipientProductRedeemDetail::select('id')->where('approval_status', 1)->where('is_completed', 0)->count();
        $limit = 25;
        $total_page = ceil($count / $limit);

        // if page count is zero then create record of current date into pagination log
        if (empty($pageCount)) {
            $created_at = new \DateTime();
            \DB::table('pagignations')->insert(['page' => 1, 'total_page' => $total_page, 'created_at' => $created_at]);
            $page_number = 1;
        } // if page count is not zero then increase the page number and update total_page
        else {
            $page_number = $pageCount['page'] + 1;

            Pagignation::whereDate("created_at", "=", date("Y-m-d", time()))->update([
                'page' => $page_number,
                'total_page' => $total_page
            ]);

            // if page number is equal to total page count then delete record of current date
            if ($page_number == $pageCount['total_page']) {
                Pagignation::whereDate("created_at", "=", date("Y-m-d", time()))->delete();
            }
        }

        $initial_page = ($page_number - 1) * $limit;
        //check today date avilable if no then insert otherwise update

        // paginate data with limit and offset
        $redeem = RecipientProductRedeemDetail::select('id')->where('approval_status', 1)->where('is_completed', 0)->skip($initial_page)->take($limit)->get()->toArray();

        if (count($redeem) > 0) {
            foreach ($redeem as $value) {
                // apply some action to the chunked results here
                // get tracking id of order
                $order = Orders::where('recipient_product_redeem_details_id', $value['id'])->pluck('tracking_id')->first();

                // fetch tracking details from pickker api
                $response = trackingOrderStatus($order);
                // check if tracking has current status 
                if (isset($response['status']) && !empty($response['status'])) {
                    $date = Carbon::parse($response['status']['current_status_time'])->format('Y-m-d');
                    $update_data['pickrr_order_status_code'] = $response['status']['current_status_type'];
                    $update_data['pickrr_order_status'] = $response['status']['current_status_body'];
                    $update_data['pickrr_current_status_time'] = $date;

                    // if order current status is delivered = DL , then update flag as delivered in database
                    if ($response['status']['current_status_type'] === 'DL') {
                        //update flag
                        $update_data['is_completed'] = 1;
                    } else {
                        $update_data['is_completed'] = 0;
                    }
                    RecipientProductRedeemDetail::where('id', $value['id'])->update($update_data);
                } else {
                    //handle error case
                    RecipientProductRedeemDetail::where('id', $value['id'])->update([
                        'pickrr_order_status_code' => 'error',
                        'pickrr_order_status' => 'delivery_error',
                    ]);
                }
            }
        }
    }

    // save e gift category by quikCilver
    public function saveEGiftCategory()
    {
        $obj = new QwikCilverController();
        $categories =  $obj->categoryList(121);

        if (count($categories) > 0) {
            EProductCategory::saveCategory($categories);
            // foreach($categories as $category){
            //     EProductCategory::saveCategory($category);
            // }
        }
    }

    // save e gift products of specific category by quikCilver
    public function saveEGiftProducts()
    {
        $obj = new QwikCilverController();
        $products =  $obj->productList(121);

        if (count($products) > 0) {
            foreach ($products as $product) {
                EProduct::saveProduct($product);
            }
        }
    }
    public function dummyOrder()
    {
        $obj = new QwikCilverController();
        $order =  $obj->dummyorder();
        print_r($order);
    }
}
