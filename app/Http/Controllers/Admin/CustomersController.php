<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function manageUsers(){
        $customers = User::where('role', 'user')
        ->select(['id', 'name', 'email', 'phone', 'created_at']) // Select only necessary columns
        ->withCount('purchases') // Eager load and count related purchases
        ->latest() // Sort by the latest
        ->paginate(10); // Paginate with 10 customers per page

            return view('auth.admin.users.manage-customers',[
            'customers' => $customers
        ]);
    }
}
