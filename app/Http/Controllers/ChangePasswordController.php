<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class ChangePasswordController extends Controller
{
    //
    public function showChangePasswordGet() {
        return view('auth.change-password');
    }

    public function changePasswordPost(Request $request) {
    	
    	$user = \Auth::guard(getAuthGaurd())->user();
    	$becrypt = $request->input('current-password');

        if (!(Hash::check($becrypt, $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->input('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $userModel = \Auth::guard(getAuthGaurd())->user();
        $userModel->password = bcrypt($request->input('new-password'));
        $userModel->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }
}
