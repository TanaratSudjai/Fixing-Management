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

            return redirect()->route('products.view')->with('success', 'Product updated successfully.');

        } catch (Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error updating product.']);
        }
    }

    public function DeleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
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
            $employee->delete();

            return redirect()->route('employee.list')->with('success', 'Employee deleted successfully.');

        } catch (Exception $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error deleting employee.']);
        }
    }
}
