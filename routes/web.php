<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\RedeemedController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function() {
    Route::get('/changePassword',[ChangePasswordController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[ChangePasswordController::class, 'changePasswordPost'])->name('changePasswordPost');
});


Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
 Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
Route::post('api/fetch-states', [RecipientController::class, 'fetchState']);
Route::post('api/fetch-cities', [RecipientController::class, 'fetchCity']);

Route::get('thanks',[RecipientController::class,'thanks'])->name('thanks');

Route::get('add-recipient/{id}',[RecipientController::class,'addRecipient'])->name('add-recipient');
Route::get('add-recipient/{id}',[RecipientController::class,'addRecipient'])->name('add-recipient');
Route::post('add-client-recipient',[RecipientController::class,'addClientRecipient'])->name('addClientRecipient');
Route::get('export',[CampaignController::class,'export'])->name('export');
Route::post('exportOrder',[CronController::class,'exportOrder'])->name('exportOrder');
Route::get('dummyOrder',[CronController::class,'dummyOrder'])->name('dummyOrder');
Route::get('exportDetail/{id}',[CampaignController::class,'exportDetail'])->name('exportDetail');
Route::get('/', function () {
    return view('home');
});

Route::get('login', function () {
    return view('welcome');
});
Route::get('campPreview/{id}',[CampaignController::class,'campPreview'])->name('campPreview');

Route::get('helpVideo',[AccountSettingController::class,'helpVideo'])->name('helpVideo');

// SAVE CONTACT FORM
Route::post('save-contact',[LeadController::class,'save']);

Route::get('sessionSet/{id}', [CampaignController::class,'changeSession']);
// auth routes for client admin and super admin
require __DIR__.'/auth.php';

// after authenticated routes for client admin and super admin and manager
require __DIR__.'/client-admin.php';
require __DIR__.'/manager.php';
require __DIR__.'/super-admin.php';

Route::get('redeem/{link}', [CampaignController::class, 'redeemGiftList']);
Route::get('redeem/{link}/{id}', [CampaignController::class, 'redeemProductDetails']);
Route::get('redeem-checkout/{link}/{id}', [CampaignController::class, 'redeemProductCheckout']);

Route::post('save-redeem-checkout', [CampaignController::class, 'saveRedeem']);
Route::get('redeem-thankyou', [CampaignController::class, 'redeemThankyou']);

// cron routes
Route::get('send-bulk-campaign-link-email', [CronController::class, 'sendBulkCampaignRedeemLinkEmail']);

Route::get('send-individual-campaign-link-email', [CronController::class, 'sendIndividualCampaignRedeemLinkEmail']);

Route::get('send-notifiction',[CronController::class,'sendReadmeNotification'])->name('sendReadmeNotification');

Route::get('update-order-if-delivered-cron',[CronController::class,'orderStatusChangeIfDelivered']);

Route::get('order-status',[CronController::class,'orderStausChange'])->name('orderStatus');

// e-gift campaign routes
Route::get('save-e-gift-category',[CronController::class,'saveEGiftCategory'])->name('orderStatus');

Route::get('save-e-products',[CronController::class,'saveEGiftProducts'])->name('save-e-products');


Route::get('email-test/{email?}', function() {
    try{
        $post = request()->all();
        $email  = !empty($post['email']) ? $post['email'] : 'anmol@ekmatra.in';
        $emailData['request'] = 'send_test_mail';
        $emailData['name'] = 'test';
          $emailData['email'] = $email;
          $emailData['from_email'] = 'info@send1.in';
          $emailData['subject'] = 'Congratulations!, you have received a gift.';
          $emailData['client_name'] = 'Test Client Name';
          $emailData['redeem_link'] = url('redeem/2939b3d6-5384-46a8-b74e-6a1511f2b340');
          $emailData['client_user_id'] = 6 ;
          $emailData['recipient_id'] = 422;
        // $description  = $data->description;

        sendMail($emailData);
        dd('done');
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }

});


Route::get('redeem-all-automatically/{id}', [CampaignController::class, 'redeemAllAutomatically']);

Route::get('dispatch-all-automatically/{id}', [RedeemedController::class, 'dispatchAllAutomatically']);

Route::get('cancel-order/{id}', [RedeemedController::class, 'cancelOrder']);

Route::get('place-order/{id}', [RedeemedController::class, 'placeOrder']);


Route::get('test-log', function(){
    \Log::channel('cronLog')->info("Testing log ::");
});