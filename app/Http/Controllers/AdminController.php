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
    public function AddEmployee(Request $req)
    {
        try {
            $validatedData = $req->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:4|confirmed',
                'status' => 'nullable|integer',
            ]);
            $employee = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'status' => 2,
            ]);

            $employee->save();
            return redirect()->route('employee.add')->with('success', 'เพิ่มพนักงานลงในรายชื่อระบบเรียบร้อยครับ');

        } catch (Exception $e) {
            Log::error('Error adding employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการเพิ่มพนักงานครับ']);
        }
    }

    public function AddProduct(Request $req)
    {
        try {
            $validatedData = $req->validate([
                'product_name' => 'required|string|max:100',
                'product_detail' => 'required|string',
                'product_qty' => 'required|integer|min:0',
                'product_price' => 'required|numeric|min:0',
            ]);
            $Product = Product::create([
                'product_name' => $validatedData['product_name'],
                'product_detail' => $validatedData['product_detail'],
                'product_qty' => $validatedData['product_qty'],
                'product_price' => $validatedData['product_price'],
            ]);

            $Product->save();
            return redirect()->route('product.add')->with('success', 'เพิ่มอะไหล่ในรายการสินค้าเรียบร้อยครับ');

        } catch (Exception $e) {
            Log::error('Error adding Product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการเพิ่มอะไหล่สินค้าครับ']);
        }
    }
    public function UpdateProduct(Request $req, $id)
    {
        try {
            $validatedData = $req->validate([
                'product_name' => 'required|string|max:100',
                'product_detail' => 'required|string',
                'product_qty' => 'required|integer|min:0',
                'product_price' => 'required|numeric|min:0',
            ]);

            $product = Product::findOrFail($id);
            $product->update([
                'product_name' => $validatedData['product_name'],
                'product_detail' => $validatedData['product_detail'],
                'product_qty' => $validatedData['product_qty'],
                'product_price' => $validatedData['product_price'],
            ]);

            return redirect()->route('product.list')->with('success', 'Product updated successfully.');

        } catch (Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error updating product.']);
        }
    }

    public function ListProduct()
    {
        $products = Product::all();
        return view('products.productview', compact('products'));
    }
    public function ListEmployee()
    {
        $employees = User::where('status', 2)->get();
        return view('employees.employeeview', compact('employees'));
    }

    public function Dashboard(){
        $countCustomer = User::where('status', 0)->count() ;
        $countEmployee = User::where('status', 2)->count() ;
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
