<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.super-admin.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $validArr = ['email' => $request->email, 
                        'password' => $request->password, 
                        'role_master_id' => $request->role_id,
                    ];
            
            if (Auth::guard('super_admin')->attempt($validArr)) {
                return response()->json(['success' => true,
                    'message' => 'Logged in successfully.',
                    'url' => url('super-admin/dashboard'),
                ], 200);
            } else {
                return response()->json(['success' => false,
                    'message' => config('constants.INVALID_USER_CREDENTIAL')
                ], 200);                
            }
            
            // $request->authenticate();

            // $request->session()->regenerate();

            // return redirect()->intended(RouteServiceProvider::HOME);
        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);            
        }        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request){
        Auth::guard(getAuthGaurd())->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();        

        return redirect('super-admin');
    }
}
