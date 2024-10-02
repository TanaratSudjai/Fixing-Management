<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Repir;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    public function AddEmployee(Request $request)
{
    try {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' ensures password confirmation matches
            'status' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        } else {
            $imagePath = null;
        }

        // Create new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status ?? 2,
            'image' => $imagePath,
        ]);

        return redirect()->route('employee.list')->with('swal_success', 'เพิ่มพนักงานลงในรายชื่อระบบเรียบร้อยครับ');

    } catch (ValidationException $e) {
        $errors = $e->validator->errors();

        // Handle email already exists error
        if ($errors->has('email')) {
            return redirect()->back()->with('email', 'อีเมลนี้มีอยู่ในระบบแล้ว')->withInput();
        }
        
        // Handle password confirmation and minimum length errors
        if ($errors->has('password')) {
            if (in_array('The password confirmation does not match.', $errors->get('password'))) {
                return redirect()->back()->with('compass', 'รหัสผ่านไม่ตรงกัน')->withInput();
            }
            if (in_array('The password must be at least 8 characters.', $errors->get('password'))) {
                return redirect()->back()->with('ePass', 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว')->withInput();
            }
        }

        return redirect()->back()->withErrors($errors)->withInput();
    }
}

    public function AddProduct(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'product_detail' => 'required|string',
                'product_qty' => 'required|integer|min:0',
                'product_price' => 'required|integer|min:0',
                'image_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('image_product')) {
                $imageName = time() . '.' . $request->file('image_product')->getClientOriginalExtension();
                $request->file('image_product')->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
            } else {
                $imagePath = null;
            }

            Product::create([
                'product_name' => $request->product_name,
                'product_detail' => $request->product_detail,
                'product_qty' => $request->product_qty,
                'product_price' => $request->product_price,
                'product_image' => $imagePath,
            ]);

            return redirect()->route('products.view')->with('success', 'เพิ่มอะไหล่ในรายการสินค้าเรียบร้อยครับ');

        } catch (Exception $e) {
            Log::error('Error adding Product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการเพิ่มอะไหล่สินค้าครับ']);
        }
    }

    public function ListProduct()
    {
        $products = Product::all();
        return view('products.productview', compact('products'));
        // return  $products ; 
    }
    public function ListEmployee()
    {
        $employees = User::where('status', 2)->get();
        return view('employees.employeeview', compact('employees'));
        // return $employees;
    }

    public function Dashboard()
    {
        $countCustomer = User::where('status', 0)->count();
        $countEmployee = User::where('status', 2)->count();
        $countProduct = Product::all()->count();
        $countRepair_done = Repir::where('status_id', 3)->count();
        $countRepair_inprogress = Repir::where('status_id', 2)->count();
        $countRepair_pending = Repir::where('status_id', 1)->count();

        $data = [
            'countCustomer' => $countCustomer,
            'countEmployee' => $countEmployee,
            'countProduct' => $countProduct,
            'countRepair_done' => $countRepair_done,
            'countRepair_inprogress' => $countRepair_inprogress,
            'countRepair_pending' => $countRepair_pending
        ];
        return view('admin.dashboard', compact('data'));
    }

}
