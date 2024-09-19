<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminManagement extends Controller
{
    //
    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit-product', compact('product'));
    }

    public function EditEmployee($id)
    {
        $employee = User::findOrFail($id);
        return view('employees.edit-employee', compact('employee'));
    }

    public function UpdateProduct(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:100',
                'product_detail' => 'required|string',
                'product_qty' => 'required|integer|min:0',
                'product_price' => 'required|numeric|min:0',
<<<<<<< HEAD
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $product = Product::findOrFail($id);

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
=======
                'image_product' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $product = Product::findOrFail($id);
            if ($req->hasFile('image_product')) {
                $image = $req->file('image_product');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/'), $imageName);

                if ($product->product_image) {
                    $oldImage = public_path('images/' . $product->product_image);
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
                $product->product_image = $imageName;
>>>>>>> 5bd47d07ea8c0ad10b4bd350b8252d0ae4538d6d
            }
            $product->update([
                'product_name' => $request->product_name,
                'product_detail' => $request->product_detail,
                'product_qty' => $request->product_qty,
                'product_price' => $request->product_price,
                'product_image' => $imagePath,
            ]);

<<<<<<< HEAD

            return redirect()->route('products.view')->with('success', 'Product updated successfully.');

=======
            // return redirect()->route('products.view')->with('success', 'Product updated successfully.');
            return $product  ; 
>>>>>>> 5bd47d07ea8c0ad10b4bd350b8252d0ae4538d6d
        } catch (Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error updating product.']);
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
            return redirect()->route('products.view')->with('success', 'Product deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error deleting product.']);
        }
    }



    public function UpdateEmployee(Request $req, $id)
    {
        try {
            $validatedData = $req->validate([
                'name' => 'required|string|max:50',
            ]);

            $employee = User::findOrFail($id);
            $employee->update([
                'name' => $validatedData['name'],
            ]);

            return redirect()->route('employee.list')->with('success', 'Employee updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error updating employee.']);
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

            return redirect()->route('employee.list')->with('success', 'Employee deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error deleting employee.']);
        }
    }
}
