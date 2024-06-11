<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /* register User */
    public function register(Request $request)
    {
        //validate data and pass it back to request
        $request = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:Users'],
            'password' => ['required', 'min:3', 'confirmed']
        ]);
        //Register using filtered request save that shit
        $request = User::create($request);

        //login use the request to login the new account
        Auth::login($request);
        //redirect
        return redirect()->route('home');
    }
    /* login code using email */
    public function login(Request $request)
    {

        //validate the data/request array
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required', 'min:3']
        ]);

        //login the account if it pass
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended('dashboard'); //intended defaults is '/' or root
        } else {
            return back()->withErrors([
                'failed' => 'login failed credential dont match on our records'
            ]);
        }
    }
    /* logout */
    public function logout(Request $request){
       //logout user
        Auth::logout();
        //invalidate current session
        $request->session()->invalidate();
        // regenerate new csrf token
        $request->session()->regenerateToken();
        //redirect to home
        return redirect()->route('post');
    }
}
