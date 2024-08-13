<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminController extends Controller
{
    public function AddEmployee(Request $req)
    {
        try {
            $validatedData = $req->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:4|confirmed',
                'status' => 'nullable|string',
            ]);
            $employee = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'status' => 2,
            ]);

            $employee->save();
            return redirect()->route('admin.dashboard')->with('success', 'เพิ่มพนักงานลงในรายชื่อระบบเรียบร้อยครับ');

        } catch (Exception $e) {
            Log::error('Error adding employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการเพิ่มพนักงานครับ']);
        }
    }
}
