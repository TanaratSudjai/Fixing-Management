<?php

namespace App\Http\Controllers;

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
        return view('employees.profile', compact('employee'));
    }
}
