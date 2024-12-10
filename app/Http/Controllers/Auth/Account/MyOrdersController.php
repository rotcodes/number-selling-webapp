<?php

namespace App\Http\Controllers\Auth\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyOrdersController extends Controller
{
    public function index()
    {
        $purchases = Auth::user()->purchases()->with('number')->latest()->get();

        return view('auth.account.my-orders', [
            'purchases' => $purchases
        ]);
    }
}
