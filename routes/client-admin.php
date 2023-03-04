<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientAdmin\ClientAdminController;
use App\Http\Controllers\ClientAdmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\eGiftController;
use App\Http\Controllers\RedeemedController;
use App\Http\Controllers\SuperAdmin\WalletController;





// client admin routes
Route::group(['prefix' => 'client-admin', 'middleware' => 'auth'], function () {
    Route::get('/', function(){
        return redirect('client-admin/dashboard');
        // return redirect('client-admin/products'); 
    });
    

    
    
    //Campaign Page routes
    Route::get('ecampaigns', [eGiftController::class, 'alleCampaignList'])->name('ecampaigns');
    Route::get('show-eproducts-list', [eGiftController::class, 'showProducts']);
    Route::get('show-eproducts-update-list', [eGiftController::class, 'showUpdateProducts']);
 
    // steps form
    Route::get('add-ecampaign', [eGiftController::class, 'add']);
    Route::post('estep-2', [eGiftController::class, 'step2']);
    Route::post('estep-3', [eGiftController::class, 'step3']);
    Route::post('save-ecampaign-final-step', [eGiftController::class, 'saveCampaignFinalStep']);


    
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

     //Recipient Page routes
     Route::get('trackorder/{id}', [CronController::class, 'trackOrder']);
     Route::get('recipients-sample', [RecipientController::class, 'downloadRecipientSample']);
     Route::get('importExcelView', [RecipientController::class, 'importView']);
     Route::post('importRecipient', [RecipientController::class, 'importRecipient']);

     //Country city state fetch api routes
     Route::get('dependent-dropdown', [RecipientController::class, 'fetchCountry']);
     Route::post('api/fetch-states', [RecipientController::class, 'fetchState']);
     Route::post('api/fetch-cities', [RecipientController::class, 'fetchCity']);

     Route::post('shareLink',[RecipientController::class, 'shareLink'])->name('shareLink');
     Route::get('recipients', [RecipientController::class, 'allRecipientList'])->name('recipients');
     Route::get('add-recipient', [RecipientController::class, 'add']);
     Route::post('save-recipient', [RecipientController::class, 'save']);
     Route::get('edit-recipient/{id}', [RecipientController::class, 'edit']);
     Route::get('status-recipient/{id}', [RecipientController::class, 'statusRecipient']);
     Route::get('delete-recipient/{id}', [RecipientController::class, 'delete']);

    //Campaign Page routes
    Route::get('campaigns', [CampaignController::class, 'allCampaignList'])->name('campaigns');
    Route::get('show-products-list', [CampaignController::class, 'showProducts']);
    Route::get('show-products-update-list', [CampaignController::class, 'showUpdateProducts']);


    //send gift
    Route::get('send-gift', [CampaignController::class, 'sendGift'])->name('sendGift');


    // steps form
    Route::get('add-campaign', [CampaignController::class, 'add']);
    Route::post('step-2', [CampaignController::class, 'step2']);
    Route::post('step-3', [CampaignController::class, 'step3']);
    Route::post('save-campaign-final-step', [CampaignController::class, 'saveCampaignFinalStep']);
    Route::get('dashboard', [ClientAdminController::class, 'index'])->name('dashboard');
    Route::get('campagian-data/{id}', [ClientAdminController::class, 'campagianData'])->name('campagianData');

    // Campaign action routes
    Route::get('view-campaign/{id}', [CampaignController::class, 'view']);
    Route::get('update-campaign-recipent/{id}', [CampaignController::class, 'updateCampaignRecipent']);
    Route::get('update-campaign-product/{id}', [CampaignController::class, 'updateCampaignProduct']);
    Route::post('saveCampagianProduct',[CampaignController::class,'saveCampagianProduct']);

    Route::post('saveCampagianRecipent',[CampaignController::class,'saveCampagianRecipent']);
    Route::get('campaign-recipients-list', [CampaignController::class, 'campaignRecipientsList']);
    Route::get('campaign-recipients-products-list', [CampaignController::class, 'campaignRecipientsProductsList']);
    Route::post('campaign-resend', [CampaignController::class, 'campaignResend']);
    Route::post('manual-redeem', [CampaignController::class, 'manualRedeem']);


    // Products routes
    Route::get('products', [ProductController::class, 'allProductLists'])->name('products');
    Route::get('all-products-render', [ProductController::class, 'allProductsRender'])->name('products-render');
    Route::post('save-product', [ProductController::class, 'save']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit']);
    Route::get('delete-product/{id}', [ProductController::class, 'delete']);
    Route::get('view-product/{id}', [ProductController::class, 'view']);
    Route::get('add-prelisted-product', [ProductController::class, 'add']);
    Route::get('swag-store', [ProductController::class, 'swagStore']);
   

    // Manager Routes
    Route::get('managers', [ManagerController::class, 'allManagerList'])->name('managers');
    Route::get('add-manager', [ManagerController::class, 'addManager']);
    Route::post('save-manager', [ManagerController::class, 'saveManager']);
    Route::get('status-manager/{id}', [ManagerController::class, 'statusManager']);
    Route::get('delete-manager/{id}', [ManagerController::class, 'delete']); 
    Route::get('edit-manager/{id}', [ManagerController::class, 'edit']);

    Route::get('groups', [GroupController::class, 'groupsList'])->name('groups');
    Route::get('status-group/{id}', [GroupController::class, 'statusGroup']);
    Route::get('add-recipient-group', [GroupController::class, 'add']);
    Route::post('save-recipient-group', [GroupController::class, 'save']);
    Route::get('edit-group/{id}', [GroupController::class, 'edit']);

    // Account Settings
    Route::get('client-settings', [AccountSettingController::class, 'accountSettings']);
    Route::get('email-settings', [AccountSettingController::class, 'emailSettings']);
    Route::get('whatsapp-settings', [AccountSettingController::class, 'whatsappSettings']);


    Route::post('save-account-setting', [AccountSettingController::class, 'accountSettingsSave']);
    Route::post('save-whatsapp-setting', [AccountSettingController::class, 'whatsappSettingsSave']);
    Route::post('email-account-setting', [AccountSettingController::class, 'emailSettingsSave']);

    // Email Templates
    Route::get('get-email-template/{id}', [CampaignController::class, 'getEmailTemplate']);

    // email sent log
    Route::get('logs', [CronController::class, 'alllogsList'])->name('logs');
    Route::get('order-logs', [CronController::class, 'orderlogsList'])->name('orderlogs');


    //wallet route
    Route::get('wallet-details', [WalletController::class, 'walletLists'])->name('wallet-details');
    Route::get('wallet-campaign', [WalletController::class, 'walletCampaign']);


    /////redeemed
    Route::get('redeemed/{client_id?}', [RedeemedController::class, 'allRedeemedList'])->name('redeemed');
    Route::get('view-redeemed/{id}', [RedeemedController::class, 'view']);


});


Route::get('/get', function(){
    // $path = storage_path().'\app\public\data.json';
    // $json = json_decode(file_get_contents($path), true); 
    // dd($json['products'][0]);

    // dd(notifcationCount());

    // $data = \App\Models\EProduct::all();
    // dd($data);

   dd(sendGridMessageFilter());
});