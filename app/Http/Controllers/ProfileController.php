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

        $countRepair_done = Repir::where('status_id', 4)->where('customer_id', $user->id)->count();
        $countRepair_inprogress = Repir::whereIn('status_id', [2, 3])->where('customer_id', $user->id)->count();
        $countRepair_pending = Repir::where('status_id', 1)->where('customer_id', $user->id)->count();

        return view('customer.profile', compact('customer', 'countRepair_done', 'countRepair_inprogress', 'countRepair_pending'));
    }
}
