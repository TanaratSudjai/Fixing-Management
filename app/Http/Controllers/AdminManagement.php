<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Repir;

class AdminManagement extends Controller
{
    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit-product', compact('product'));
    }

    public function EditEmployee($id)
    {
        
        $employee = User::findOrFail($id);
        return view('employees.edit-employee', compact('employee'));
        // return $employee;
    }

    public function selectemployee($id)
    {
        try {
            $repair = Repir::findOrFail($id);

            $employees = User::where('status', 2)->get();

            // if (!$repair) {
            //     return redirect()->back()->with('error', 'ไม่พบรายการซ่อมที่ต้องการแก้ไข');
            // }
    
            return view('admin.listRepaitforadmin', compact('repair', 'employees'));
        } catch (Exception $e) {
            Log::error('Error fetching repair record for editing: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to fetch repair record for editing.']);
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $product = Product::findOrFail($id);
            if ($request->hasFile('image')) {
                if ($product->product_image && file_exists(public_path($product->product_image))) {
                    unlink(public_path($product->product_image));
                }
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
            } else {
                $imagePath = $product->product_image;
            }
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
            return redirect()->back()->with('success', 'แก้ไขอะไหล่สินค้าสำเร็จครับ');
        }
    }

    public function DeleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->product_image && file_exists(public_path($product->product_image))) {
                unlink(public_path($product->product_image));
            }
            $product->delete();
            return redirect()->route('products.view');
        } catch (Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error deleting product.']);
        }
    }

    public function UpdateEmployee(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $employee = User::findOrFail($id);
            if ($request->hasFile('image')) {
                if ($employee->image && file_exists(public_path($employee->image))) {
                    unlink(public_path($employee->image));
                }
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
            } else {
                $imagePath = $employee->product_image;
            }
            $employee->update([
                'name' => $validatedData['name'],
                'image' => $imagePath,
            ]);
            return redirect()->route('employee.list')->with('success', 'อัพเดทพนักงานสำเร็จแล้ว');
        } catch (Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function DeleteEmployee($id)
    {
        try {
            $employee = User::findOrFail($id);

            if ($employee->image && file_exists(public_path($employee->image))) {
                unlink(public_path($employee->image));
            }
            $employee->delete();

            return redirect()->route('employee.list')->with('success', 'พนักงานได้ถูกลบแล้ว');
        } catch (Exception $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error deleting employee.']);
        }
    }
}
