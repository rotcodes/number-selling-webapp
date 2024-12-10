<?php

namespace App\Http\Controllers\Auth\Account;

use App\Http\Controllers\Controller;
use App\Models\Number;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShowNumbersController extends Controller
{
    public function index(){
        $numbers = Number::all();
        return view('auth.account.show-numbers',[
            'numbers' => $numbers
        ]);
    }

    public function buyNumber(Request $request, $id)
    {
        $number = Number::findOrFail($id);
        $user = Auth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Create a new purchase record
        $purchase = new Purchase();
        $purchase->number_id = $number->id;
        $purchase->user_id = $user->id;
        $purchase->total_price = $number->price;
        $purchase->name = $request->name;
        $purchase->phone = $request->phone;
        $purchase->save();

        session()->flash('success', 'Thanks!. We received your purchase request and will contact you shortly.');

        return response()->json(['status' => true]);
    }
}
