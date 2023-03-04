<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientManager\ClientManagerController;
use App\Http\Controllers\ClientAdmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\SuperAdmin\WalletController;


// client admin routes
Route::group(['prefix' => 'manager', 'middleware' => 'auth'], function () {

    Route::get('/', function(){
        return redirect('manager/dashboard');
    });
     //Recipient Page routes
     Route::get('trackorder/{id}', [CronController::class, 'trackOrder']);
     Route::get('recipients-sample', [RecipientController::class, 'downloadRecipientSample']);
     Route::get('importExcelView', [RecipientController::class, 'importView']);
     Route::post('importRecipient', [RecipientController::class, 'importRecipient']);

     //Country city state fetch api routes
     Route::get('dependent-dropdown', [RecipientController::class, 'fetchCountry']);
     Route::post('api/fetch-states', [RecipientController::class, 'fetchState']);
     Route::post('api/fetch-cities', [RecipientController::class, 'fetchCity']);

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

    // steps form
    Route::get('add-campaign', [CampaignController::class, 'add']);
    Route::post('step-2', [CampaignController::class, 'step2']);
    Route::post('step-3', [CampaignController::class, 'step3']);
    Route::post('save-campaign-final-step', [CampaignController::class, 'saveCampaignFinalStep']);
    
    Route::get('dashboard', [ClientManagerController::class, 'index'])->name('dashboard');
    
    // Campaign action routes
    Route::get('view-campaign/{id}', [CampaignController::class, 'view']);
    Route::get('update-campaign-recipent/{id}', [CampaignController::class, 'updateCampaignRecipent']);
    Route::get('update-campaign-product/{id}', [CampaignController::class, 'updateCampaignProduct']);
    Route::post('saveCampagianProduct',[CampaignController::class,'saveCampagianProduct']);

    Route::post('saveCampagianRecipent',[CampaignController::class,'saveCampagianRecipent']);
    Route::get('campaign-recipients-list', [CampaignController::class, 'campaignRecipientsList']);
    Route::get('campaign-recipients-products-list', [CampaignController::class, 'campaignRecipientsProductsList']);

    // Products routes
    Route::get('products', [ProductController::class, 'allProductLists'])->name('products');
    Route::post('save-product', [ProductController::class, 'save']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit']);
    Route::get('delete-product/{id}', [ProductController::class, 'delete']);
    Route::get('view-product/{id}', [ProductController::class, 'view']);
    Route::get('add-prelisted-product', [ProductController::class, 'add']);

    // Manager Routes
    

    Route::get('groups', [GroupController::class, 'groupsList'])->name('groups');
    Route::get('status-group/{id}', [GroupController::class, 'statusGroup']);
    Route::get('add-recipient-group', [GroupController::class, 'add']);
    Route::post('save-recipient-group', [GroupController::class, 'save']);
    Route::get('edit-group/{id}', [GroupController::class, 'edit']);

    // Account Settings
    Route::get('client-settings', [AccountSettingController::class, 'accountSettings']);
    Route::get('email-settings', [AccountSettingController::class, 'emailSettings']);

    Route::post('save-account-setting', [AccountSettingController::class, 'accountSettingsSave']);
    Route::post('email-account-setting', [AccountSettingController::class, 'emailSettingsSave']);

    // Email Templates
    Route::get('get-email-template/{id}', [CampaignController::class, 'getEmailTemplate']);

    // email sent log
    Route::get('logs', [CronController::class, 'alllogsList'])->name('logs');
    Route::get('order-logs', [CronController::class, 'orderlogsList'])->name('orderlogs');


    //wallet route
    Route::get('wallet-details', [WalletController::class, 'walletLists'])->name('wallet-details');
    Route::get('wallet-campaign', [WalletController::class, 'walletCampaign']);



});

