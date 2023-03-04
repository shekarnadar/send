<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        //mange count;
        \Session::put('campaign_count', getTotalCampaingsCount('today'));
        \Session::put('lead_count', getLeadCount('today'));
        \Session::put('redeemed_count', totalRedeemedCount('today'));
        \Session::put('log_count', getAllLogCount('today'));
        \Session::put('order_count', getAllOrdersCount('today'));
            // The user is logged in...
        
        /* @description validation for check valid email format (axy@test.com) 
         * @return type boolean
         */
        Validator::extend('check_email_format', function ($attribute, $value, $parameters, $validator) {
            $post = request()->all();
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return false;
            } else {
                return true;
            }
        });

        /**
         * @description function for phone number validation
         * @return type boolean
         */
        Validator::extend('phone_format', function ($attribute, $value, $parameters, $validator) {
            if ($value != "") {
                return preg_match("/^(\+\d{1,3}[- ]?)?\d{4,12}$/", $value);
            } else {
                return true;
            }
        });

        /* @description validation for check valid email
         * @return type boolean
         */
        Validator::extend('user_email_valid', function ($attribute, $value, $parameters, $validator) {
            $users = \DB::table('users')->where(['email' => $value])
                    ->where('status', '!=', 'deleted')
                    ->first(['id']);
            if (!empty($users)) {
                return true;
            } else {
                return false;
            }
        });

        /* @description validation for check current password is correct or not
         * @return type boolean
         */
        Validator::extend('current_password_match', function ($attribute, $value, $parameters, $validator) {
            $accessToken = request()->header('authorization');
            if (!empty($accessToken)) {
                $user = JWTAuth::toUser($accessToken);
                $password = $user->password;
            } else {
                $password = auth('venue')->user()->password;
            }
            return \Hash::check($value, $password);
        });

        /* @description validation for text field does not contain only space
         * @return type boolean
         */
        Validator::extend('remove_spaces', function($attribute, $value, $parameters, $validator) {
            if (trim($value) == '') {
                return false;
            }
            return true;
        });     
        
      
    }
}
