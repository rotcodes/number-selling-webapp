<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }


    public function authenticate(Request $request)
    {
        // Customize error messages
        $messages = [
            'g-recaptcha-response.required' => 'The reCAPTCHA is required.',
            'g-recaptcha-response.recaptcha' => 'Invalid reCAPTCHA, please try again.',
        ];
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|recaptcha'

        ], $messages);

        if ($validator->passes()){

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('dashboard')->with('success', 'Attempt Successfull. Welcome to the system.');
            } else {
                return redirect()->route('login')->withInput($request->only('email'))->with('error', 'Invalid login attempt. Please double check your credentials.');
            }

        } else {
            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out from system successfully.');
    }
}
