<?php

namespace App\Http\Controllers\ClientAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\ClientAdmin;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password' => ['required'],
            ]);

            $user = ClientAdmin::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['success' => true,
                'message' => config('constants.USER_REGISTERED_SUCCESS'),
                'url' => url('/'),
                ], 200);
            return redirect('/login');
            // event(new Registered($user));

            // Auth::login($user);

            // return redirect(RouteServiceProvider::HOME);

        } catch(\Exception $e){
            return response()->json(['success' => false,'message' => 'Something Went Wrong'], 200);            
        }
    }
}
