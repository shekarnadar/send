<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class QwikCilverController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $username;
    private $password;
    private $prefixUrl;    

    public function __construct(){
        $this->clientId = 'b009d497ccf41326f26029c2bec180dd';
        $this->clientSecret = '17dfd7ef33688e31f77055dcdb89fca6';
        $this->username = 'ekmatrasandboxapi@woohoo.in';
        $this->password = 'ekmatrasandboxapi@123';
        $this->prefixUrl = 'https://sandbox.woohoo.in/';
    }

    // generate auth code and bearer token
    public function generateAuthCode(){
        $data = [];

        // $clientId = 'b009d497ccf41326f26029c2bec180dd';
        // $clientSecret = '17dfd7ef33688e31f77055dcdb89fca6';
        // $username = 'ekmatrasandboxapi@woohoo.in';
        // $password = 'ekmatrasandboxapi@123';

        $verifyUrl = $this->prefixUrl.'oauth2/verify';
        // Generate auth token
        $response = Http::withHeaders([
             'Content-Type' => 'application/json',
             'Accept' => '*/*',
         ])->post($verifyUrl,[
                'clientId' => $this->clientId,
                'username' => $this->username,
                'password' => $this->password,
        ])->json();

        if(!empty($response['authorizationCode'])){
            $data['authorizationCode'] = $response['authorizationCode'];
            
            $bearerTokenUrl = 'https://sandbox.woohoo.in/oauth2/token';
            // Generate bearer token
            $response = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
             ])->post($bearerTokenUrl,[
                    'clientId' => $this->clientId,
                    'clientSecret' => $this->clientSecret,
                    'authorizationCode' => $response['authorizationCode'],
            ])->json();

            if(!empty($response['token'])){
                $data['bearerToken'] = $response['token'];
            }
        }

        return $data;
    }


    // fetch category
    public function categoryList($catId){
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $categoryUrl = $this->prefixUrl.'rest/v3/catalog/categories'."/$catId";
        $encodedUrl = 'GET&'.urlencode($categoryUrl);

        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->get($categoryUrl)->json();

            return $cateResponse;
        }

        return [];

        // curl --location --request GET 'https://sandbox.woohoo.in/rest/v3/catalog/categories?q=1' \
        // --header 'Content-Type: application/json' \
        // --header 'Accept: */*' \
        // --header 'dateAtClient: 2022-12-05T12:20:31.604Z' \
        // --header 'signature: a126106b1d84a7824df1288bf2036f0a73e63b585b0eaa59871508d6f3dc3912a9dad6c8709d9ee86af7d2da9045a899a4693d8172977ce25b2390740e08b6ab' \
        // --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjb25zdW1lcklkIjoiMzY2IiwiZXhwIjoxNjcwODM5ODMwLCJ0b2tlbiI6IjEyMzNjM2MzYjA2NmVkZjk4MDllNmExYzVhYjQyMzQ0In0.xKwDPI66qwmtIJPjraiBV8O6VMNoKVIgfbcdgM_pIeQ'

    }


    // fetch products list by categoryId
    public function productList($catId){
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/catalog/categories/'.$catId.'/products';

        $encodedUrl = 'GET&'.urlencode($url);

        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->get($url)->json();

            return @$cateResponse['products'];
        }

        return [];


        // curl --location --request GET 'https://sandbox.woohoo.in/rest/v3/catalog/categories/4/products?offset=offset&limit=limit' \
        // --header 'Content-Type: application/json' \
        // --header 'Accept: */*' \
        // --header 'dateAtClient: 2022-12-06T09:04:31.780Z' \
        // --header 'signature: 0bcdc09754cde14b89a313253da58908a385c09fa13d3a6fd61d0f07733172e0c3c410d67de2bdbdde7f05ab132290f03e8d68fd54af9ee1b4c2f081cab1998e' \
        // --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjb25zdW1lcklkIjoiMzY2IiwiZXhwIjoxNjcwODM5ODMwLCJ0b2tlbiI6IjEyMzNjM2MzYjA2NmVkZjk4MDllNmExYzVhYjQyMzQ0In0.xKwDPI66qwmtIJPjraiBV8O6VMNoKVIgfbcdgM_pIeQ'

    }


    // fetch products detail by sku
    public function productDetails($productSku){
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/catalog/products/'.$productSku;
        $encodedUrl = 'GET&'.urlencode($url);

        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->get($url)->json();

            print_r($cateResponse); 
        }

        // curl --location --request GET 'https://sandbox.woohoo.in/rest/v3/catalog/categories/4/products?offset=offset&limit=limit' \
        // --header 'Content-Type: application/json' \
        // --header 'Accept: */*' \
        // --header 'dateAtClient: 2022-12-06T09:04:31.780Z' \
        // --header 'signature: 0bcdc09754cde14b89a313253da58908a385c09fa13d3a6fd61d0f07733172e0c3c410d67de2bdbdde7f05ab132290f03e8d68fd54af9ee1b4c2f081cab1998e' \
        // --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjb25zdW1lcklkIjoiMzY2IiwiZXhwIjoxNjcwODM5ODMwLCJ0b2tlbiI6IjEyMzNjM2MzYjA2NmVkZjk4MDllNmExYzVhYjQyMzQ0In0.xKwDPI66qwmtIJPjraiBV8O6VMNoKVIgfbcdgM_pIeQ'

    }

    public function dummyorder(){
        $refrence_id =  mt_rand( 1000000000, 9999999999 )."_qwickgift";
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/orders';
        $payload = [
          "address" => [
             "salutation"=>'',
              "firstname" =>'Jhon',
              "lastname" => 'Deo',
              "email" => 'jhon.deo@gmail.com',
              "telephone" =>'+919999999999',
              "line1" => 'address details1',
              "line2" => 'address details 2',
              "city" => 'bangalore',
              "region" => 'Karnataka',
              "country" => 'IN',
              "postcode" =>  '560076',
          ],
          "billing" => [
            "salutation"=>'',
            "firstname" =>'Jhon',
            "lastname" => 'Deo',
            "email" => 'jhon.deo@gmail.com',
            "telephone" =>'+919999999999',
            "line1" => 'address details1',
            "line2" => 'address details 2',
            "city" => 'bangalore',
            "region" => 'Karnataka',
            "country" => 'IN',
            "postcode" =>  '560076',
          ],
          "payments" => [
            [
              "code" => "svc",
              "amount" => 100,
              "poNumber" => "johndeo01"
            ]
          ],
          "refno" => $refrence_id,
          "products" => [
            [
              "sku" => "EGVGBTNS001",
              "price" => 100,
              "qty" => 1,
              "currency" => 356,
              "payout" => [
                "type" => "BANK_ACCOUNT",
                "ifscCode"=> "001000000abc",
                "name"=> "abc test",
                "accountNumber" => "1234567890123456",
                "telephone"=> "+91888888888",
                "transactionType"=> "IMPS",
                "email"=> "test@gmail.com"
              ]
            ]
          ]
        ];
       
        $encodedUrl = 'POST' . '&' .$url . '&' . http_build_query($payload);
        echo $encodedUrl;
        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();


        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->post($url,$payload)->json();

            print_r($cateResponse);
          }

    }

    // create order
    public function createOrder($qwickGift){
        $refrence_id =  mt_rand( 1000000000, 9999999999 )."qwickgift";
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/orders';
        $encodedUrl = 'POST&'.urlencode($url);
        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->post($url,[
                  "address" => [
                    "firstname" =>$qwickGift['firstname'],
                    "lastname" => $qwickGift['lastname'],
                    "email" => $qwickGift['email'],
                    "telephone" => $qwickGift['phone'],
                    "line1" => $qwickGift['line1'],
                    "line2" => $qwickGift['line2'],
                    "city" => $qwickGift['city'],
                    "region" => $qwickGift['state'],
                    "country" => $qwickGift['country'],
                    "postcode" =>  @$qwickGift['postalcode'],
                    "company" => "",
                    "billToThis" => true
                  ],
                  "billing" => [
                    "firstname" => $qwickGift['firstname'],
                    "lastname" => $qwickGift['lastname'],
                    "email" => $qwickGift['email'],
                    "telephone" => $qwickGift['phone'],
                    "line1" => $qwickGift['line1'],
                    "line2" => $qwickGift['line2'],
                    "city" => $qwickGift['city'],
                    "region" => $qwickGift['state'],
                    "country" => $qwickGift['country'],
                    "postcode" => @$qwickGift['postalcode'],
                    "company" => ""
                  ],
                  "payments" => [
                        [
                          "code" => "svc",
                          "amount" => $qwickGift['amount']
                        ]
                    ],
                  "refno" => $refrence_id,
                  "syncOnly" => true,
                  "deliveryMode" => "API",
                  "products" => [
                        [
                          "sku" => $qwickGift['sku'],
                          "price" => $qwickGift['amount'],
                          "qty" => 1,
                          "currency" => $qwickGift['currency'],
                          "theme" => ""
                        ]
                    ]
             ])->json();

            return $cateResponse;
        }


            // curl --location --request POST 'https://sandbox.woohoo.in/rest/v3/orderStatus' \
            // --header 'Content-Type: application/json' \
            // --header 'Accept: */*' \
            // --header 'dateAtClient: 2022-12-06T09:32:12.335Z' \
            // --header 'signature: a7b2abffd3d4ab2d92cba5d21054205aa938605a7173b356c5b7d2ae02e48fd7bfc32ac6922bd5085f9b1f179696fd0308addcc9c1468605df18ca6a3c82a90e' \
            // --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjb25zdW1lcklkIjoiMzY2IiwiZXhwIjoxNjcwOTIzMzkwLCJ0b2tlbiI6ImFmNmMyMWIwMzI0N2JiNzlkMjk2ZjFkMDYyYmUzMjQ0In0.zeZQWK6A_cltaM0hRjYeuATh3PV2zEWqT6jxVJt7DiA' \
            // --data-raw '{
            //   "address": {
            //     "firstname": "",
            //     "lastname": "K",
            //     "email": "email id here",
            //     "telephone": "Mobile here",
            //     "line1": "Qwikcilver Solutions",
            //     "line2": "111, BMC,Koramangala",
            //     "city": "bangalore",
            //     "region": "Karnataka",
            //     "country": "IN",
            //     "postcode": "560095",
            //     "company": "",
            //     "billToThis": true
            //   },
            //   "billing": {
            //     "firstname": "Paramasivan ",
            //     "lastname": "Billing",
            //     "email": "email id here",
            //     "telephone": "Mobile here",
            //     "line1": "billing 1",
            //     "line2": "Billing  2",
            //     "city": "bangalore",
            //     "region": "Karnataka",
            //     "country": "IN",
            //     "postcode": "560095",
            //     "company": ""
            //   },

            //   "payments":[
            //     {
            //       "code": "svc",
            //       "amount": 100
            //     }
            // ],
              
            //   "refno": "qc0075",
            //   "syncOnly": true,
            //  "deliveryMode": "API",

            //   "products":[
            //     {
            //       "sku": "WWQ556GBX001",
            //       "price": 100,
            //       "qty": 1,
            //       "currency": "036",
            //       "theme": ""
            //     }
            // ]
            // }
            // '

    }

    // fetch order status detail by sku
    public function orderStatus($refno){
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/order'.$refno.'/status';
        $encodedUrl = 'GET&'.urlencode($url);

        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->get($url)->json();

            print_r($cateResponse);
        }

        // curl --location --request GET 'https://sandbox.woohoo.in/rest/v3/order/test5003/status' \
        // --header 'Content-Type: application/json' \
        // --header 'Accept: */*' \
        // --header 'dateAtClient: 2022-12-06T10:13:35.499Z' \
        // --header 'signature: bac7480098829a17688888e932807cb8866168130dc5904d7505dd39c83c8e20cb8c86e967ae990a3e445f774a092d602a346f9dee1cb619b7248566c3c67ac1' \
        // --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjb25zdW1lcklkIjoiMzY2IiwiZXhwIjoxNjcwOTIzMzkwLCJ0b2tlbiI6ImFmNmMyMWIwMzI0N2JiNzlkMjk2ZjFkMDYyYmUzMjQ0In0.zeZQWK6A_cltaM0hRjYeuATh3PV2zEWqT6jxVJt7DiA' \
        // --data-raw ''

    }

    // fetch activated cards
    public function activatedCards($orderIdentityNumber){
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/order'.$orderIdentityNumber.'/cards';
        $encodedUrl = 'GET&'.urlencode($url);

        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->get($url)->json();

            print_r($cateResponse);
        }
    }

    // fetch balance by card sku
    public function getBalanceByCard($sku){
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/balance';
        $encodedUrl = 'GET&'.urlencode($url);

        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->post($url,[
                'cardNumber' => '1234567890123456',
                'pin' => '123456',
                'sku' => 'WOOHOO'
             ])->json();

            print_r($cateResponse);
        }
    }

    // fetch transaction history by card
    public function getTransactionHistory(){
        $dateAtClient = \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s.v\Z');
        $url = $this->prefixUrl.'rest/v3/transaction/history';
        $encodedUrl = 'GET&'.urlencode($url);

        $signature = hash_hmac('sha512', $encodedUrl, $this->clientSecret);

        $authArr = $this->generateAuthCode();

        if(!empty($authArr['authorizationCode']) && !empty($authArr['bearerToken'])){
            $cateResponse = Http::withHeaders([
                 'Content-Type' => 'application/json',
                 'Accept' => '*/*',
                 'dateAtClient' => $dateAtClient,
                 'signature' => $signature,
                 'Authorization' => 'Bearer '.$authArr['bearerToken'],
             ])->post($url,[
                "startDate" =>  "2019-01-24T15:59:59Z",
                "endDate" => "2020-10-19T20:59:59Z",
                "limit" => 100,
                "offset" => 0,
                "cards" => [
                    [
                    "cardNumber" => "9999998880016217",
                    "pin" => "321721"
                    ]
                ]
             ])->json();

            print_r($cateResponse);
        }
    }

    public static function generateAccessToken(){
        // step 0 :  client has to enter values here.. all 4 values will be proviced by qwikcilver

        $consumerKey = 'b009d497ccf41326f26029c2bec180dd';   // eg : 797987988989798798797(Provided by Qwikcilver)
        $consumerSecret = '17dfd7ef33688e31f77055dcdb89fca6'; // eg : 898980980980909890090 (Provided by Qwikcilver)
        $username = 'ekmatrasandboxapi@woohoo.in';     // client@client.com (Provided by Qwikcilver)
        $password = 'ekmatrasandboxapi@123';     //clientpassword (Provided by Qwikcilver)


        //Oauth url's

        $temporaryCredentialsRequestUrl = "https://sandbox.woohoo.in/oauth/initiate?oauth_callback=oob";//request token url
        $authorizationUrl = 'https://sandbox.woohoo.in/oauth/authorize/customerVerifier?oauth_token=';//authorize url
        $accessTokenRequestUrl = 'http://sandbox.woohoo.in/oauth/token';//access token url


        try {

            //token generation will consist of three steps
            //step 1:generate request tokens

            $authType = OAUTH_AUTH_TYPE_URI;

            //OAuth is a php oauthClient Library which consists methods
            //for generating Request Tokens and Access Tokens, the
            //library also consists methods for making api calls

            $oauthClient = new OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, $authType);
            $oauthClient->enableDebug();
            $requestToken = $oauthClient->getRequestToken($temporaryCredentialsRequestUrl);// return type array

            //step 2:do a curl call to authorizationUrl which will return verifer and success parameter
            $ch = curl_init();
            $url = $authorizationUrl . $requestToken['oauth_token'] . '&username=' . $username . '&password=' . $password;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST, 0); //1 for a post request
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
            curl_setopt($ch,CURLOPT_TIMEOUT, 20);
            $verifierResponse = json_decode(curl_exec($ch));
            curl_close ($ch);

            //step 3:if received a success parameter as true then call the access token url and exchange the request tokens for access tokens
            if($verifierResponse->success == 1) {
                $oauthClient->setToken($requestToken['oauth_token'], $requestToken['oauth_token_secret']);
                $verifier_token = $verifierResponse->verifier;
                $accessToken = $oauthClient->getAccessToken($accessTokenRequestUrl,null,$verifier_token);// return type array


                // this is the generated access token and security key.
                echo "<br/><br/><br/>Access Token : ". $accessToken['oauth_token']."<br/>";
                echo "<br/>Access Token Security Key : ". $accessToken['oauth_token_secret']."<br/>";
            }
        } catch (OAuthException $e) {
            print_r($e->getMessage());
            echo "<br/>";
            print_r($e->lastResponse);
        }
    }

}
