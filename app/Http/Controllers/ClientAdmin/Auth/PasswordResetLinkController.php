<?php

namespace App\Http\Controllers\ClientAdmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use App\Models\User;



class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try{
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = \Str::random(64);
  
          \DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
          $pass = \Str::random(10);
          $becrypt =  bcrypt($pass);
          User::where('email',$request->email)->update([
            'password' => $becrypt
          ]);

          $emailData['request'] = 'send_forget_password_mail';
          $emailData['email'] = trim($request->email);
          $emailData['from_email'] = 'info@send1.in';
          $emailData['pass'] = $pass;
          sendMail($emailData);
        
         
           return response()->json(['success' => true,
                'message' => 'Successfully sent new password.'
            ], 200);

        }catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => $e->getMessage()], 200);
        }  
        
  

        
    }
}
