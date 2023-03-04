<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperAdmin\Auth\AuthenticationController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuperAdmin\WalletController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\RedeemedController;
use App\Http\Controllers\CronController;


// super admin auth routes

Route::group(['prefix' => 'super-admin'], function(){

    Route::group(['middleware' => 'guest-super-admin'], function () {
        Route::get('login', [AuthenticationController::class, 'create'])
                    ->name('login');

        Route::post('login', [AuthenticationController::class, 'login']);

        // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        //             ->name('password.request');

        // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        //             ->name('password.email');

        // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        //             ->name('password.reset');

        // Route::post('reset-password', [NewPasswordController::class, 'store'])
        //             ->name('password.update');
    });

    // super admin routes

    Route::group(['middleware' => 'auth-super-admin'], function () {
        Route::get('changeshortUrl',[CronController::class,'changeshortUrl']);

        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware('throttle:6,1')
                    ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::post('logout', [AuthenticationController::class, 'destroy'])
                    ->name('logout');

        Route::get('/', function(){
            return redirect('super-admin/dashboard');
        });

        Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
        Route::get('client-data/{id}',[SuperAdminController::class, 'clientWiseData'])->name('clientData');
        // client routes
        Route::get('clients', [ClientController::class, 'allClientsList'])->name('client');
        Route::get('add-client-admin', [ClientController::class, 'addClient']);
        Route::post('save-client', [ClientController::class, 'saveClient']);
        Route::get('edit-client/{id}', [ClientController::class, 'editClient']); 
        Route::get('delete-client/{id}', [ClientController::class, 'deleteClient']);
        Route::get('status-client/{id}', [ClientController::class, 'statusClient']);
        Route::get('view-client/{id}', [ClientController::class, 'viewClient']);
        Route::get('view-client-admin/{id}', [ClientController::class, 'viewClientAdmin']);

        //Recipient Page routes

         Route::get('recipients', [RecipientController::class, 'allRecipientList'])->name('recipients');
         Route::get('add-recipient', [RecipientController::class, 'add']);
         Route::post('save-recipient', [RecipientController::class, 'save']);
         Route::get('edit-recipient/{id}', [RecipientController::class, 'edit']);
         Route::get('status-recipient/{id}', [RecipientController::class, 'statusRecipient']);
         Route::get('delete-recipient/{id}', [RecipientController::class, 'delete']);
         Route::get('view-client-recipients/{id}', [RecipientController::class, 'ViewClientRecipient']);

        //Campaign Page routes

        Route::get('campaigns', [CampaignController::class, 'allCampaignList'])->name('campaigns');
        Route::get('clientcampaigns/{clicnt_id}', [CampaignController::class, 'clientCampaignList'])->name('clientcampaignsList');
        Route::get('add-campaign', [CampaignController::class, 'add']);
        Route::get('send-list', [CampaignController::class, 'SendList']);
        Route::get('send-option', [CampaignController::class, 'SendOption']);
        Route::get('change-campaign-status/{id}/{status}', [CampaignController::class, 'changestatusCampaign']);
        Route::get('exportClientCampgian/{client_id}',[CampaignController::class,'exportClientCampgian'])->name('exportClientCampgian');


        // Products routes
        // Route::get('products', [ProductController::class, 'index'])->name('products');

        // Client Admin Routes
        Route::get('add-client-details/{id}', [ClientController::class, 'addClientDetails']);
        Route::post('save-client-admin', [ClientController::class, 'saveClientAdmin']);
        Route::get('client-admins-ajax/{id}', [ClientController::class, 'clientAdminsAjax']);
        Route::get('status-client-admin/{id}', [ClientController::class, 'statusClientAdmin']);
        Route::get('edit-client-admin/{client_id}/{client_admin_id}', [ClientController::class, 'editClientAdmin']);


        //wallet page
        Route::get('wallet', [WalletController::class, 'allWalletLists'])->name('wallet');
        Route::get('add-wallet', [WalletController::class, 'add']);
        Route::post('save-wallet', [WalletController::class, 'save']);
        Route::get('edit-wallet/{id}', [WalletController::class, 'edit']);

        // Products routes
        // Route::get('products', [ProductController::class, 'allProductLists'])->name('products');
        // Route::post('save-product', [ProductController::class, 'save']);
        // Route::get('edit-product/{id}', [ProductController::class, 'edit']);
        // Route::get('delete-product/{id}', [ProductController::class, 'delete']);
        // Route::get('view-product/{id}', [ProductController::class, 'view']);
        // Route::get('add-prelisted-product', [ProductController::class, 'add']);


        // Products routes
        Route::get('products', [ProductController::class, 'allProductLists'])->name('products');
        Route::get('all-products-render', [ProductController::class, 'allProductsRender'])->name('products-render');

        Route::post('save-product', [ProductController::class, 'save']);
        Route::get('edit-product/{id}', [ProductController::class, 'edit']);
        Route::get('delete-product/{id}', [ProductController::class, 'delete']);
        Route::get('view-product/{id}', [ProductController::class, 'view']);
        Route::get('company-products', [ProductController::class, 'companyProducts'])->name('company-products');
        Route::get('add-prelisted-product', [ProductController::class, 'add']);
        Route::get('status-product/{id}', [ProductController::class, 'statusProduct']);


        // Campaign action routes
        Route::get('view-campaign/{id}', [CampaignController::class, 'view']);
        Route::get('campaign-recipients-list', [CampaignController::class, 'campaignRecipientsList']);
        Route::get('campaign-recipients-products-list', [CampaignController::class, 'campaignRecipientsProductsList']);
        Route::post('campaign-resend', [CampaignController::class, 'campaignResend']);
        Route::post('manual-redeem', [CampaignController::class, 'manualRedeem']);


        // Leads
        Route::delete('leads/{id}',[LeadController::class,'deleteLead'])->name('deletelead');
        Route::get('leads', [LeadController::class, 'allLeadsList'])->name('leads');
        Route::post('saveComment', [LeadController::class, 'saveComment'])->name('saveComment');
        Route::post("saveStatus",[LeadController::class,'saveStatus'])->name('saveStatus');
        Route::get('view-lead/{id}', [LeadController::class, 'leadsDetail'])->name('leadsDetail');


        //Country city state fetch api routes
        Route::get('dependent-dropdown', [RecipientController::class, 'fetchCountry']);
        Route::post('api/fetch-states', [RecipientController::class, 'fetchState']);
        Route::post('api/fetch-cities', [RecipientController::class, 'fetchCity']);


        // redeemed product details
        Route::get('redeemed', [RedeemedController::class, 'allRedeemedList'])->name('redeemed');
        Route::get('view-redeemed/{id}', [RedeemedController::class, 'view']);
        Route::get('change-redeemed-status/{id}/{status}', [RedeemedController::class,'changeStatusRedeemed']);
        Route::post('multipleDispatch', [RedeemedController::class, 'multipleDispatch'])->name('multipleDispatch');

        Route::get('view-pdf/{id}', [RedeemedController::class, 'viewOrderLablePdf']);


        // Route::get('add-campaign', [CampaignController::class, 'add']);
        // Route::get('send-list', [CampaignController::class, 'SendList']);
        // Route::get('send-option', [CampaignController::class, 'SendOption']);
        // Route::get('change-campaign-status/{id}/{status}', [CampaignController::class, 'changestatusCampaign']);

        Route::get('logs', [CronController::class, 'alllogsList'])->name('logs'); 
        Route::get('order-logs', [CronController::class, 'orderlogsList'])->name('orderlogs');
        Route::get('trackorder/{id}', [CronController::class, 'trackOrder']);


    });
});
