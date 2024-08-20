<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class RegistorController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('auth.register'); 
    }
    public function register(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => 0, // ตั้งค่า status เป็น 0
        ]);

        // Redirect to login or another page
        return redirect()->route('login.form')->with('success', 'Registration successful. Please log in.');
    }
}
