<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\SuperAdmin\EmailSettingRequest;
use App\Http\Requests\Client\WhatsappSettingRequest;
use App\Models\User;
use App\Models\Log;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailSetting;
use App\Jobs\SendEmailJob;

class AccountSettingController extends Controller
{
     public function helpVideo(){
        return view('client-admin.help-video');
    }
    // save contant details
    public function accountSettings() {
        return view('client-admin.account-settings');
    }

    public function emailSettings() {
        return view('client-admin.email-settings');
    }

    public function emailSettingsSave(EmailSettingRequest $request) {
        try {
            $post = $request->all();

            $clientAdmin = \Auth::guard(getAuthGaurd())->user();
            $modal = EmailSetting::where('client_admin_id', $clientAdmin->id)->first();

          
                // $clientSettingEmail = $post['clientadmin_email'];
                // $clientSettingPassword = $post['clientadmin_password'];
                // setEmailConfig($clientSettingEmail, $clientSettingPassword);

                // $emailData['request'] = 'send_credentials_mail';
                // $emailData['name'] = ucwords($clientAdmin['first_name'].' '.$clientAdmin['last_name']);
                // $emailData['email'] = $post['clientadmin_email'];
                // $emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
                // $emailData['subject'] = 'Credentials for login in EM-Send.';
                // $emailData['client_user_id'] = $clientAdmin->id;
                // $emailData['recipient_id'] = '';
                // $emailData['redeem_link'] ="";
                // $emailData['loginurl']=url('/login');
                // $emailData['description'] = 'Congratulations, Your Email is working please save your mail: Email <b>'.$clientSettingEmail.'</b>';
                
                // try{
                //     Mail::send('email.send-credentials', ['data' => $emailData], function ($message) use ($emailData) {
                //         $message->to($emailData['email'])
                //                 ->from($emailData['from_email'], 'em-send')
                //                 ->subject($emailData['subject']);
                //     });

                //     return response()->json(['success' => true,
                //             'message' => 'Email sent successfully.'
                //         ], 200);
                // } catch(\Exception $e){
                //     return response()->json(['error' => true,
                //         'message' => 'Email not sent please check your email credentials.'
                //     ], 200);
                // }

            /** email test and check log table and save dynamic email credential */
            if($post['btnValue'] == "test"){

                $clientSettingEmail = trim($post['clientadmin_email']);
                $clientSettingPassword = $post['clientadmin_password'];
                setEmailConfig($clientSettingEmail, $clientSettingPassword);

                $emailData['request'] = 'send_credentials_mail';
                $emailData['name'] = ucwords($clientAdmin['first_name'].' '.$clientAdmin['last_name']);
                $emailData['email'] = trim($post['clientadmin_email']);
                $emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
                $emailData['subject'] = 'Credentials for login in Send.';
                $emailData['client_user_id'] = $clientAdmin->id;
                $emailData['recipient_id'] = '';
                $emailData['redeem_link'] ="";
                $emailData['loginurl']=url('/login');
                $emailData['description'] = 'Congratulations, Your Email is working please save your mail: Email <b>'.$clientSettingEmail.'</b>';
                
                try{
                    Mail::send('email.send-credentials', ['data' => $emailData], function ($message) use ($emailData) {
                        $message->to($emailData['email'])
                                ->from($emailData['from_email'], 'Send')
                                ->subject($emailData['subject']);
                    });

                    return response()->json(['success' => true,
                            'message' => 'Email sent successfully.'
                        ], 200);
                } catch(\Exception $e){
                    return response()->json(['error' => true,
                        'message' => 'Email not sent please check your email credentials.'
                    ], 200);
                }

            } else {
                $clientSettingEmail = trim($post['clientadmin_email']);
                $clientSettingPassword = $post['clientadmin_password'];
                setEmailConfig($clientSettingEmail, $clientSettingPassword);
                $emailData['request'] = 'send_credentials_mail';
                $emailData['name'] = ucwords($clientAdmin['first_name'].' '.$clientAdmin['last_name']);
                $emailData['email'] = trim($post['clientadmin_email']);
                $emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
                $emailData['subject'] = 'Credentials for login in Send.';
                $emailData['client_user_id'] = $clientAdmin->id;
                $emailData['recipient_id'] = '';
                $emailData['redeem_link'] ="";
                $emailData['loginurl']=url('/login');
                $emailData['description'] = 'Congratulations, Your Email is working please save your mail: Email <b>'.$clientSettingEmail.'</b>';

                try{
                    Mail::send('email.send-credentials', ['data' => $emailData], function ($message) use ($emailData) {
                        $message->to($emailData['email'])
                                ->from($emailData['from_email'], 'Send')
                                ->subject($emailData['subject']);
                    });
                        if(!empty($modal->client_admin_id)){
                            EmailSetting::where('client_admin_id', $clientAdmin->id)
                            ->update(['email' => trim($post['clientadmin_email']), 'password' => $post['clientadmin_password']]);
                        }else{
                             $count = EmailSetting::count();
                             $modalem = new EmailSetting();
                            $modalem->id = $count + 1;
                            $modalem->client_admin_id = $clientAdmin->id;
                            $modalem->email = $post['clientadmin_email'];
                            $modalem->password = $post['clientadmin_password'];
                            $modalem->save();
                        }

                        return response()->json(['success' => true,
                            'message' => 'Details saved successfully.'
                        ], 200);
                    // }else{
                    //     return response()->json(['error' => true,
                    //         'message' => 'Smtp details not correct.'
                    //     ], 200);
                    // }
                }catch(\Exception $e){
                        return response()->json(['error' => true,
                        'message' => 'Details not save.'
                    ], 200);
                }
               

            }
        } catch(\Exception $e){
            echo $e->getMessage();
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

    public function accountSettingsSave(Request $request) {
        try {
            User::saveLogo($request);
            return response()->json(['success' => true,
                'message' => config('constants.LOGO_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            echo $e->getMessage(); exit;
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

    public function whatsappSettings(Request $request) {
        $clientId = \Auth::guard(getAuthGaurd())->user()->client_id;
        $client = Client::where('id',$clientId)->first();
        return view('client-admin.whatsapp-settings',compact('client'));   
    }
    public function whatsappSettingsSave(WhatsappSettingRequest $request) {
         $post = $request->input();
         try {
            Client::saveWhatsappSetting($post);
            return response()->json(['success' => true,
                'message' => config('constants.WHATSAPP_SETTING_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            echo $e->getMessage(); exit;
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }
}
