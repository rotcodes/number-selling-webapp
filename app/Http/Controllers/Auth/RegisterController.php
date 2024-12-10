<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
            // Customize error messages
            $messages = [
            'g-recaptcha-response.required' => 'The reCAPTCHA is required.',
            'g-recaptcha-response.recaptcha' => 'Invalid reCAPTCHA, please try again.',
        ];

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits_between:10,15',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|same:password', // 'confirmed' ensures the passwords match
            'g-recaptcha-response' => 'required|recaptcha'
        ], $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Create and save the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'Account has been created successfully!.');

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully!'
        ]);
    }
}
