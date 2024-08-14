<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login'); // ฟอร์มล็อกอิน
    }

    // จัดการการล็อกอิน
    public function login(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $userId = Auth::id();
            session()->put('message', 'Welcome back, ' . $user->name);

            if ($user->status == 1) {

                return redirect()->route('active');
            } else if ($user->status == 0) {

                return redirect()->route('customer.dashboard');
            } else if ($user->status == 2) {
                return redirect()->route('employee.dashboard');
            }
            return redirect()->route('home');
        }

        // Authentication failed
        return Redirect::back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    // จัดการการออกจากระบบ
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
