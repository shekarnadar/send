<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Config;
use App\Models\Log;
use App\Models\Orders;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\RecipientProductRedeemDetail;
use App\Models\Notification;
use Illuminate\Notifications\Notifiable;

/**
 * @description function for send mail
 * @param type $data
 * @return boolean
 */

function sendMail($data)
{
    try {
        switch ($data['request']) {
            case "send_credentials_mail":
                Mail::send('email.send-credentials', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])
                        ->from($data['from_email'], 'Send')
                        ->subject($data['subject']);
                });
                break;
            case "send_forget_password_mail":
                Mail::send('email.forgetPassword', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])
                        ->from($data['from_email'], 'Send')
                        ->subject('Reset Password');
                });
                break;
            case "send_new_lead_mail":
                Mail::send('email.new-lead-mail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])
                        ->from($data['from_email'], 'Send')
                        ->subject($data['subject']);
                });
                break;
            case "final-step-campaign":
                Mail::send('email.final-step-campaign', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])
                        ->from($data['from_email'], 'Send')
                        ->subject($data['subject']);
                });
                break;
            case "send_test_mail":
                Mail::send('email.test', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])
                        ->from($data['from_email'], 'Send')
                        ->subject($data['subject']);
                });
                break;


            default:
                break;
        }
        return true;
    } catch (\Exception $e) {
        print_r($e->getMessage() . 'on line' . $e->getLine());
        die;
        return $e->getMessage();
    }
}


/**
 * @description function for generate random otp or password, default length is 4 characters
 * @param type $type $length
 * @return type string
 */
function generateRandomStringToken($type, $length = 4)
{
    if ($type == 'otp') {
        return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
    } else {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}

/**
 * convert date to database date format
 * @param type $string,$format
 * @return date
 */
function getFormatedDate($string, $format)
{
    return Carbon::parse($string)->format($format);
}

function transformDate($value, $format = 'Y-m-d')
{
    try {
        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    } catch (\ErrorException $e) {
        return \Carbon\Carbon::createFromFormat($format, $value);
    }
}

/**
 * convert time to database time format
 * format 14:00
 * @param type $string
 * @return date
 */
function dbTimeFormat($string)
{
    return Carbon::parse($string)->format('H:i:s');
}

/**
 * get date with day
 * @param type $string
 * @return type
 */
function dayTimeFormat($string)
{
    return Carbon::parse($string)->format('l , jS F Y');
}

/**
 * format 2010-12-30UTC23:21:46+00:00
 * @param type $string
 * @return date
 */
function fullTimeFormat($string)
{
    $dt = new DateTime($string);
    return $dt->format('Y-m-dTH:i:sP');
}

/**
 * format 12/20/2019
 * @param type $string
 * @return date
 */
function monthDateYear($string, $type = null)
{
    if (!empty($string)) {
        if (!empty($type) && $type == 'with_time') {
            return Carbon::parse($string)->format('m/d/Y h:i A');
        }
        return Carbon::parse($string)->format('m/d/Y');
    }
    return NULL;
}

/**
 * format 17-07-2019
 * @param type $string
 * @return date
 */
function dateMonthYear($string)
{
    if (!empty($string)) {
        return Carbon::parse($string)->format('d-m-Y');
    }
    return NULL;
}

/*
 * Convert time zone
 */

function convertTimeZone($fromTimeZone, $toTimeZone, $dateTime)
{
    $date = new \DateTime($dateTime, new \DateTimeZone($fromTimeZone));
    $date->setTimezone(new \DateTimeZone($toTimeZone));
    return $date;
}

/**
 * @description convert time according to location e.g. $dateTime = 12:00:00, $toTz = Asia/Kolkala, $fromTz = UTC
 * @param type $dateTime
 * @return type $timezone
 */
function converToTz($dateTime, $toTz = null, $fromTz = null)
{
    $convertedDateTime = date('Y-m-d H:i:s', strtotime($dateTime));
    if (empty($toTz)) {
        $toTz = !empty(Auth::user()->time_zone) ? Auth::user()->time_zone : 'America/Toronto';
    }
    if (empty($fromTz)) {
        $fromTz = 'UTC';
    }

    // convert timezone fromTimeZone to toTimeZone
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $convertedDateTime, $fromTz);
    $date->setTimezone($toTz);
    return $date;

    // timezone by php friendly values
    //        if (empty($toTz)) {
    //            $toTz = 'America/Toronto';
    //        }
    //        if (empty($fromTz)) {
    //            $fromTz = 'UTC';
    //        }
    //    $date = new \DateTime($dateTime, new \DateTimeZone($fromTz));
    //    $date->setTimezone(new \DateTimeZone($toTz));
    //        $data['date'] = $date->format('Y-m-d');
    //        $data['time'] = $date->format('H:i:s');
    //        $data['tz'] = $date->format('P');
    //        return $data;
}

function convertToBoolean($string)
{
    return filter_var($string, FILTER_VALIDATE_BOOLEAN);
}


function withTwoDecimalValue($val)
{
    return $val > 0 ? number_format($val, 2, '.', '') : 0;
}


function endDateTime($startDate, $startTime, $duration)
{
    return Carbon::parse($startDate . ' ' . $startTime)->addMinute($duration);
}

function shortDescription($string, $limit)
{
    // strip tags to avoid breaking any html
    $string = strip_tags($string);
    if (strlen($string) > $limit) {
        // truncate string
        $stringCut = substr($string, 0, $limit);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    return $string;
}


/*
 * function for upload images.
 */

function uploadFile($image, $folder = null)
{
    try {
        $destination = public_path() . '/uploads/' . $folder;
        if (!is_dir($destination)) {
            File::makeDirectory($destination, $mode = 0777, true, true);
        }
        $imageName = time() . rand(11111, 99999) . '.' . $image->getClientOriginalExtension();

        $fileName = str_replace(" ", "-", $imageName);
        if (uploadFileExist($destination, $fileName)) {
            if ($image->move($destination, $fileName)) {
                return ['success' => true, 'fileName' => $fileName];
            } else {
                return ['success' => false, 'message' => "Error in uploading file."];
            }
        }
    } catch (\Exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    }
}

/*
 * Unlink old image of user
 */

function unlinkImageFunction($image, $folder = null)
{
    $fileName = public_path() . '/uploads/' . $folder . '/' . $image;
    if (!empty($image) && file_exists($fileName)) {
        unlink($fileName);
    }
}


/*
 * get image url and set image path
 */

function getImage($image, $folder = null)
{
    $src = url('assets/images/default-user.jpg');
    if ($folder == 'product') {
        $src = url('assets/images/no-image.jpg');
    }

    if ($folder == 'logo') {
        $src = url('assets/images/send-logo.jpeg');
    }

    if ($folder == null) {
        $src = config('constants.S3_HOST_URL') . $image;
    } else {
        $src = config('constants.S3_HOST_URL') . $folder . '/' . $image;
    }

    $fileName = "config('constants.S3_HOST_URL')" . $folder . '/' . $image;
    if (!empty($image) && file_exists($fileName)) {
        $src = url('uploads/' . $folder . '/' . $image);
    }
    if (empty($image)) {
        if ($folder == 'logo') {
            $src = url('assets/images/send-logo.jpeg');
        } else {
            $src = url('assets/images/no-image.jpg');
        }
    }



    return $src;
}

/*
 * function using for check file ex already
 * return filename
 */

function uploadFileExist($destination, $fileName)
{
    if (!file_exists($destination . '/' . $fileName)) {
        return true;
    } else {
        return false;
    }
}


function uploads3File($folderName, $request)
{
    $fileName = time() . rand(11111, 99999) . '.' . $request->image->getClientOriginalExtension();
    $path = $request->image->move('/tmp', $fileName);
    $s3 = \App::make('aws')->createClient('s3');
    $res = $s3->putObject(array(
        'Bucket'     => 'send-staging',
        'Key'        => $folderName . '/' . $fileName,
        'SourceFile' => $path->getPathName(),
    ));
    return $fileName;
}

function deleteGcsFile($link)
{
    $disk = Storage::disk('gcs');
    return $disk->delete(str_replace(\Config::get('constants.GOOGLE_CLOUD_STORAGE_API_URI'), '', $link));
}

// get signed url for limit access of gcs rosource
function getSignedGcsUrl($objPath, $type = null, $duration = 7200)
{
    if (empty($objPath)) {
        $src = url('public/images/default-user.jpg');

        if ($type == 'drink-category' || $type == 'venue' || $type == 'offers') {
            $src = url('public/images/no-image.jpg');
        }

        return $src;
    }
    // return \Config::get('constants.GOOGLE_CLOUD_STORAGE_API_URI').$objPath;
    return Storage::disk('gcs'/* following your filesystem configuration */)
        ->getAdapter()
        ->getBucket()
        ->object($objPath)
        // ->signedUrl(new \DateTime('+ ' . $duration . ' minutes'));
        ->signedUrl(new \DateTime('+ 7200 minutes'));
}

function getAuthGaurd()
{
    if (\Auth::guard('client_admin')->check()) {
        return 'client_admin';
    } else if (\Auth::guard('super_admin')->check()) {
        return 'super_admin';
    } else if (\Auth::guard('manager')->check()) {
        return 'manager';
    } else {
        return '';
    }
}
function getUrl()
{
    if (\Auth::guard('client_admin')->check()) {
        return 'client-admin/';
    } else if (\Auth::guard('super_admin')->check()) {
        return 'super-admin/';
    } else if (\Auth::guard('manager')->check()) {
        return 'manager/';
    } else {
        return '';
    }
}

function getLoggedInUserDetails()
{
    if (\Auth::guard('super_admin')->check()) {
        return User::where([
            'id' => auth('super_admin')->user()->id,
            'role_master_id' => 1
        ])->first();
    } else if (\Auth::guard('client_admin')->check()) {
        return User::where([
            'id' => auth('client_admin')->user()->id,
            'role_master_id' => 3
        ])->first();
    } else if (\Auth::guard('manager')->check()) {
        return User::where([
            'id' => auth('manager')->user()->id,
            'role_master_id' => 4
        ])->first();
    } else {
        return '';
    }
}

function country($id)
{
    $data = Country::where('id', $id)->first();

    if (!empty($data)) {
        return $data;
    }
    return [];
}

function state($id)
{
    $data = State::where('id', $id)->first();

    if (!empty($data)) {
        return $data;
    }
    return [];
}

function city($id)
{
    $data = City::where('id', $id)->first();

    if (!empty($data)) {
        return $data;
    }
    return [];
}

function urlPrefix()
{
    $urlPrefix = '';
    if (getAuthGaurd() == 'super_admin') {
        $urlPrefix = 'super-admin';
    } else if (getAuthGaurd() == 'client_admin') {
        $urlPrefix = 'client-admin';
    } else if (getAuthGaurd() == 'manager') {
        $urlPrefix = 'manager';
    }
    return $urlPrefix;
}

function groupsNames($list)
{
    $arr = [];

    foreach ($list as $key => $val) {
        $arr[$key] = $val->group_name;
    }

    return implode(',', $arr);
}

function setEmailConfig($email, $password)
{

    $config = array(
        'driver'     => 'smtp',
        'host'       => 'smtp.gmail.com',
        'port'       => '587',
        'username'   => $email,
        'password'   => $password,
        'encryption' => 'tls',
        'from'       => array('address' => $email, 'name' => $password),
        'sendmail'   => '/usr/sbin/sendmail -bs',
        'pretend'    => false,
    );

    Config::set('mail', $config);
}
function getTemplatePreview($data, $id)
{
    if (empty($data['token']) || $data['token'] == 'NULL') {
        $token = env('WHATSAPP_TOKEN');
    } else {
        $token = $data['token'];
    }

    if (empty($data['url']) || $data['url'] == 'NULL') {
        $url = env('WHATSAPP_URL') . '/api/v1/templates/getById/' . $id;
    } else {
        $url = $data['url'] . '/api/v1/templates/getById/' . $id;
    }
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get($url)->throw()->json();
        return $response['result'];
    } catch (\Exception $e) {
        return 0;
    }
}
function getTemplate($data)
{
    if (empty($data['token']) || $data['token'] == 'NULL') {
        $token = env('WHATSAPP_TOKEN');
    } else {
        $token = $data['token'];
    }

    if (empty($data['url']) || $data['url'] == 'NULL') {
        $url = env('WHATSAPP_URL') . '/api/v1/getMessageTemplates';
    } else {
        $url = $data['url'] . '/api/v1/getMessageTemplates';
    }
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get($url)->throw()->json();
        return $response['messageTemplates'];
    } catch (\Exception $e) {
        return 0;
    }
}
function sendWhatsappMessage($data)
{
    // \Log::info('Helper.sendWhatsappMessage');
    //\Log::info($data);
    \Log::channel('cronLog')->info('Helper.sendWhatsappMessage');
    \Log::channel('cronLog')->info($data);

    if (empty($data['template_name']) || $data['template_name'] == 'NULL') {
        $request['template_name'] = env('TEMPLATE_NAME');
    } else {
        $request['template_name'] = $data['template_name'];
    }

    if (empty($data['broadcast_name']) || $data['broadcast_name'] == 'NULL') {
        $request['broadcast_name'] = env('BROADCAST_NAME');
    } else {
        $request['broadcast_name'] = $data['broadcast_name'];
    }

    if (empty($data['token']) || $data['token'] == 'NULL') {
        $token = env('WHATSAPP_TOKEN');
    } else {
        $token = $data['token'];
    }

    if (empty($data['url']) || $data['url'] == 'NULL') {
        $url = env('WHATSAPP_URL') . '/api/v1/sendTemplateMessage';
    } else {
        $url = $data['url'] . '/api/v1/sendTemplateMessage';
    }
    $request['parameters'][] = [
        "name" => "tracking_url",
        "value" => $data['redeem_link']
    ];
    $data['medium'] = 'whatsapp';
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->post($url . '?whatsappNumber=91' . $data['phone'], $request);
        $data['description'] = 'success';
        $data['status'] = true;
        Log::saveLog($data);
        // \Log::info('try block');
        //\Log::info($data);
        \Log::channel('cronLog')->info('WhatsApp Sucess');
        \Log::channel('cronLog')->info($data);
    } catch (\Exception $e) {

        \Log('Catch block');
        $data['description'] = $e->getMessage();
        $data['status'] = false;
        // \Log::info($data);
        \Log::channel('cronLog')->info($data);
        // Log::saveLog($data);
    }
}

function trackingOrderStatus($id)
{
    if (env('local', 'staging')) {
        $auth = config('constants.PICKER_AUTH_TOKEN');
    } else {
        $auth = config('constants.PICKER_PRO_AUTH_TOKEN');
    }
    $url = 'https://async.pickrr.com/track/tracking/';
    $data = array(
        'tracking_id' => $id,
        'auth_token' => $auth
    );
    $params = '';
    foreach ($data as $key => $value)
        $params .= $key . '=' . $value . '&';
    $params = trim($params, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '?' . $params); //Url together with parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7); //Timeout after 7 seconds
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($result, true);
    return $json;
}

function cancelOrder($id)
{

    $params['auth_token'] = config('constants.PICKER_AUTH_TOKEN');
    $params['tracking_id'] = $id;
    try {
        $json_params = json_encode($params);
        $url = 'https://pickrr.com/api/order-cancellation/';
        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        print_r($response);
        curl_close($ch);


        Orders::where('tracking_id', $id)->firstorfail()->delete();
        return 1;
    } catch (\Exception $e) {
        return $result;
    }
}

function dispatchOrder($productDetails, $product, $request)
{
    if (env('local', 'staging')) {
        $params['auth_token'] = config('constants.PICKER_AUTH_TOKEN');
        $params['from_phone_number'] = config('constants.PICKER_FROM_PHONE_NUMBER');
        $params['from_pincode'] = config('constants.PICKER_FROM_PINCODE');
    } else {
        $params['auth_token'] = config('constants.PICKER_PRO_AUTH_TOKEN');
        $params['from_phone_number'] = config('constants.PICKER_PRO_FROM_PHONE_NUMBER');
        $params['from_pincode'] = config('constants.PICKER_PRO_FROM_PINCODE');
    }

    $params['item_name'] = $product->name;
    $params['from_name'] = 'EKMATRA';
    $params['from_address'] = 'Crescent industrial estate, survey no 2381/1, Behind Classic Stripes, Chinpada, Gokhivare Village, Vasai East.Palghar 401208';
    $params['to_name'] = $request['first_name'] . " " . $request['last_name'];
    $params['to_pincode'] = $request['postal_code'];
    $params['to_phone_number'] = $request['phone'];
    $params['to_address'] = $request['address_line_1'];
    $params['quantity'] = 1;
    $params['invoice_value'] = $product->price;
    $params['is_reverse'] = False;

    try {
        $json_params = json_encode($params);
        $url = 'https://www.pickrr.com/api/place-order/';
        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        curl_close($ch);

        if (isset($response['courier_errors'])) {
            return $response['courier_errors'];
        } else {
            Orders::create([
                'recipient_product_redeem_details_id' => $productDetails,
                'order_id' => $response['order_id'],
                'status' => $response['success'],
                'tracking_id' => $response['tracking_id'],
                'order_response' => $result
            ]);
            return 1;
        }
    } catch (\Exception $e) {
        return $result;
    }
}

function getOptions($url = null, $id = null, $status = null)
{
    return view('options', [
        'id' => $id,
        'status' => $status,
        'url' => $url,
    ]);
}

function genrateShortLink($url)
{
    $builder = new \AshAllenDesign\ShortURL\Classes\Builder();
    $shortURLObject = $builder->destinationUrl($url)->make();
    $shortURL = $shortURLObject->default_short_url;
    $urlKeyArray = explode('/', $shortURL);
    $urlKey = end($urlKeyArray);
    return $shortURL;
}

function emilDescription($template_id, $first_name, $client_name, $last_name, $description)
{

    if ($template_id == 1) {
        $words = ["{{FIRST_NAME}}", "{{CLIENT_NAME}}"];
        $replaceWords   = [$first_name, $client_name];
        $newPhrase = str_replace($words, $replaceWords, $description);
    } else if ($template_id == 2) {
        $words = ["{{FIRST_NAME}}", "{{LAST_NAME}}"];
        $replaceWords   = [$first_name, $last_name];
        $newPhrase = str_replace($words, $replaceWords, $description);
    } else {
        $newPhrase = $data->description;
    }
    return $newPhrase;
}

function convertDate()
{
    $time  = Carbon::now('Asia/Kolkata');
    return $time;
}

function getLogo($urlPrefix, $image)
{
    if ($urlPrefix == 'super-admin') {
        $logoUrl = url('assets/images/send-logo.jpeg');
    } else {
        if ($urlPrefix == 'manager') {
            $id = \Auth::guard(getAuthGaurd())->user()->parent_uer_id;
            $logo = User::select('client_admin_logo')->find($id);
        } else {
            $logo = $image;
        }
        if ($logo == 'NULL' || empty($logo)) {
            $logoUrl = url('assets/images/send-logo.jpeg');
        } else {
            $logoUrl = getImage($image, 'logo');
        }
    }
    return  $logoUrl;
}
function pinCode($code)
{
    $response = Http::get('http://www.postalpincode.in/api/pincode/' . $code)->throw()->json();
    return $response;
}
function getTotalCampaingsCount($today = null)
{
    $user = \Auth::guard(getAuthGaurd())->user();
    $campaignList = Campaign::where('is_deleted', 0);
    if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
        $client_id = $user->client_id;
        $campaignList->where(['client_id' => $client_id]);
    }
    if ($today) {
        $campaignList->whereDate('created_at', Carbon::today());
    }
    $campaignList = $campaignList->count();
    return $campaignList;
}
function getLeadCount($today = null)
{
    if ($today) {
        $count = Lead::whereDate('created_at', Carbon::today())->count();
    } else {
        $count = Lead::count();
    }
    return $count;
}
function getAllOrdersCount($today = null)
{
    $client = \Auth::guard(getAuthGaurd())->user();

    if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
        if (getAuthGaurd() == 'manager') {
            $id = $client->parent_user_id;
        } else {
            $id = $client->id;
        }
        $data = Orders::whereHas('recipientReedme', function ($query) use ($id) {
            $query->where('client_id', '=', $id);
        })->count();
    } else {
        if ($today) {
            $data = Orders::whereDate('created_at', Carbon::today())->count();
        } else {
            $data = Orders::count();
        }
    }
    return $data;
}

function getAllLogCount($today = null)
{
    if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
        $clientId = \Auth::guard(getAuthGaurd())->user()->client_id;
        $data = Log::where(['client_user_id' => $clientId])->count();
    } else {
        if ($today) {
            $data = Log::whereDate('created_at', Carbon::today())->count();
        } else {
            $data = Log::count();
        }
    }
}
function notifcationCount($today = null){
    $user_id = \Auth::guard(getAuthGaurd())->user()->id;   
    if($today){
        $date = Carbon::today()->subDays(7)->toDateString();
        $data = Notification::where('from_id',$user_id)->whereDate('created_at', '>=',$date)->count();
    }else{
            $data = Notification::where('from_id',$user_id)->count();
    }
    return $data;
}

function totalRedeemedCount($today = null)
{
    if ($today) {
        $data = RecipientProductRedeemDetail::whereDate('created_at', Carbon::today())->count();
    } else {
        $data = RecipientProductRedeemDetail::count();
    }
    return $data;
}

function totalRedeemedCountClient($client)
{

    $data = RecipientProductRedeemDetail::where('client_id', $client)->count();

    return $data;
}

function getClientName($client_id)
{
    $user = User::where('client_id', $client_id)->first();
    return $user->first_name . ' ' . $user->last_name;
}


function sendGridMessageFilter()
{
    $data =  http_build_query([
        'from_email' => "info@send1.in",
        'limit' => 100
    ]);

    try {
        $url = 'https://api.sendgrid.com/v3/messages';
        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . env("MAIL_PASSWORD")
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        curl_close($ch);
        // dd($response['messages'][0]['to_email']);
        return $response['messages'];
    } catch (\Exception $e) {
        return $e;
    }
}
