<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Log;


class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = $this->details;

        if (!empty($data['client_user_id']));
        if (!empty($data['recipient_id']));
        if (!empty($data['redeem_link']));
        if (!empty($data['email_description']));
        if (!empty($data['campaign_id']));
        $data['client_user_id'] = !empty($data['client_user_id']) ? $data['client_user_id'] : NULL;
        $data['recipient_id'] = !empty($data['recipient_id']) ? $data['recipient_id'] : NULL;
        $data['redeem_link'] = !empty($data['redeem_link']) ? $data['redeem_link'] : NULL;
        $data['email_description'] = !empty($data['email_description']) ? $data['email_description'] : NULL;
        $data['campaign_id'] = !empty($data['campaign_id']) ? $data['campaign_id'] : NULL;

        $data['medium'] = 'email';

        //print_r($data); exit;
      
        try{
            switch ($data['request']) { 
                case "send_credentials_mail":
                    
                    $data['email'] = $data['email']? $data['email'] : null;
                    $data['password'] = $data['password']? $data['password'] : null;

                    Mail::send('email.send-credentials', ['data' => $data], function ($message) use ($data) {
                        $message->to($data['email'])
                            ->from(config('constants.FROM_EMAIL'), 'Send')
                            ->subject($data['subject']);
                    });
                    
                    $data['description'] = 'success';
                    $data['status'] = true;
 

                    break;
                case "send_redeem_gift_link_mail":
                    $mail_response = Mail::send('email.redeem-gift-link', ['data' => $data], function ($message) use ($data) {
                        $message->to($data['email'])
                            ->from('info@send1.in', 'Send')
                            ->subject($data['subject']);
                    });

                    $data['description'] = 'success';
                    $data['status'] = true;
                    Log::saveLog($data); 

                    break;
                case "instant-approval-campaign":
                    $mail_response =  Mail::send('email.final-step-campaign', ['data' => $data], function ($message) use ($data) {
                        $message->to($data['email'])
                            ->from(config('constants.FROM_EMAIL'), 'Send')
                            ->subject($data['subject']);
                    });

                    $data['description'] = 'success';
                    $data['status'] = true;
                    Log::saveLog($data);
 

                    break;
                    // case "verification_password_otp_mail":
                    //     Mail::send('email.verification_password_otp_mail', ['data' => $data], function ($message) use ($data) {
                    //         $message->to($data['email'])
                    //                 ->from($data['from_email'], 'em-send')
                    //                 ->subject($data['subject']);
                    //     });
                    //     break;
                    // case "forgot_password_otp_mail":
                    //     Mail::send('email.forgot_password_otp_mail', ['data' => $data], function ($message) use ($data) {
                    //         $message->to($data['email'])
                    //                 ->from($data['from_email'], 'em-send')
                    //                 ->subject($data['subject']);
                    //     });
                    //     break;
                    // case "request_approved_by_admin":
                    //     Mail::send('email.notification_mail', ['data' => $data], function ($message) use ($data) {
                    //         $message->to($data['email'])
                    //                 ->from($data['from_email'], 'em-send')
                    //                 ->subject($data['subject']);
                    //     });
                    //     break;
                default:
                    break;
            }
        } catch (\Exception $e) {
            $data['description'] = $e->getMessage();
            $data['status'] = false;
            // \Log::error('email log :::: ======================>'.$e->getMessage());
            \Log::channel('cronLog')->info('email log :::: ======================>' . $e->getMessage());
            
            Log::saveLog($data);
        } 
    }
}
        