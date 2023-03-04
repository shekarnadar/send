<?php

namespace App\Http\Controllers\ClientAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        try {

            $user = User::where('email', $request->email)->first();
            if(empty($user)){
                return response()->json(['success' => false,
                    'message' => config('constants.INVALID_USER_CREDENTIAL')
                ], 200);
            }

            $validArr = ['email' => $request->email, 
                    'password' => $request->password, 
                    'role_master_id' => $user->role_master_id,
                    'is_active' => 1,
                     ];
                    //  echo $request->password;
                    // exit();
            $userGuard = $user->role_master_id == 3 ? 'client_admin' : 'manager';

            if (Auth::guard($userGuard)->attempt($validArr)) {
                $client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
                $clientDetails = Client::getDetailById($client_id);
               
                if($clientDetails['is_active'] !=1) {
                    return response()->json(['success' => false,
                    'message' => config('constants.COMPANY_INACTIVATED')
                ], 200);
                }
                //last_login_at
                $clientAdminId = \Auth::guard(getAuthGaurd())->user()->id;
                $last_login = date('Y-m-d H:i:s');
                DB::table('users')
                ->where('id', $clientAdminId)
                ->update(['last_login_at' => $last_login]);

                $urlPrefix = $userGuard == 'client_admin' ? 'client-admin' : 'manager';
                return response()->json(['success' => true,
                    'message' => 'Logged in successfully.',
                    'url' => url($urlPrefix.'/dashboard'),
                ], 200);
            }

            if (!Auth::guard($userGuard)->attempt($validArr)) {
                //exit('out');
                // return redirect()->back()->withErrors(['Invalid credentials']);
                return response()->json(['success' => false,
                    'message' => config('constants.INVALID_USER_CREDENTIAL')
                ], 200);
            }

            // $request->authenticate();

            // $request->session()->regenerate();

            // return redirect()->intended(RouteServiceProvider::HOME);
        } catch(\Exception $e){
           // echo $e->getMessage(); exit;
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
    public function destroy(Request $request)
    {
        Auth::guard(getAuthGaurd())->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
