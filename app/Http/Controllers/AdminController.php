<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Repir;


class AdminController extends Controller
{
    public function AddEmployee(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'status' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file(key: 'image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
            } else {
                $imagePath = null;
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 2,
                'image' => $imagePath,
            ]);

            return redirect()->route('admin.addEmployee')->with('success', 'เพิ่มพนักงานลงในรายชื่อระบบเรียบร้อยครับ');

        } catch (Exception $e) {
            Log::error('Error adding employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการเพิ่มพนักงานครับ: ' . $e->getMessage()])->withInput();
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

            return redirect()->route('product.add')->with('success', 'เพิ่มอะไหล่ในรายการสินค้าเรียบร้อยครับ');

        } catch (Exception $e) {
            Log::error('Error adding Product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการเพิ่มอะไหล่สินค้าครับ']);
        }
    }
    public function UpdateProduct(Request $request, $id)
    {
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'product_detail' => 'required|string',
                'product_qty' => 'required|integer|min:0',
                'product_price' => 'required|integer|min:0',
                'image_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $product = Product::findOrFail($id);

            // Handle image update
            if ($request->hasFile('image_product')) {
                // Delete the old image if it exists
                if ($product->product_image && file_exists(public_path($product->product_image))) {
                    unlink(public_path($product->product_image));
                }

                // Upload the new image
                $imageName = time() . '.' . $request->file('image_product')->getClientOriginalExtension();
                $request->file('image_product')->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
            } else {
                $imagePath = $product->product_image; // Keep the existing image if no new one is uploaded
            }

            // Update product data
            $product->update([
                'product_name' => $request->product_name,
                'product_detail' => $request->product_detail,
                'product_qty' => $request->product_qty,
                'product_price' => $request->product_price,
                'product_image' => $imagePath,
            ]);

            return redirect()->route('product.list')->with('success', 'แก้ไขอะไหล่สินค้าสำเร็จครับ');

        } catch (Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการแก้ไขอะไหล่สินค้าครับ']);
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
