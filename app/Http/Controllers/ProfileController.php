<?php

namespace App\Http\Controllers;

use App\Models\Repir;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function getProfile()
    {
        $user = Auth::user();
        $employee = User::where('id', $user->id)->first();
        $workHistory = Repir::with('customer', 'employee', 'product', 'status')
            ->where('employee_id', $user->id)
            ->where('status_id', 4)
            ->get();
        return view('employees.profile', compact('employee', 'workHistory'));
        // return $workHistory;
    }

    public function getProfileCustomer()
    {
        $user = Auth::user();
        $customer = User::where('id', $user->id)->first();
        return view('customer.profile', compact('customer'));
    }
}
