<?php

namespace App\Http\Controllers\Auth\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $purchases = Auth::user()->purchases()->with('number')->latest()->get();

        return view('auth.account.dashboard',[
            'purchases' => $purchases,
        ]);
    }
}
