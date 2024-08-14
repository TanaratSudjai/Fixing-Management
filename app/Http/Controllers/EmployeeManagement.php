<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Repir;
use App\Models\Status;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\User;
class EmployeeManagement extends Controller
{
    //
    public function listwork()
    {
        $workrepair = Repir::with('customer')->get();

        return view('work.work', compact('workrepair'));
    }

    public function selectProduct($id)
    {
        try {
            $repair = Repir::findOrFail($id);
            $product = Product::all();
            return view('work.productselect', compact('repair', 'product'));

        } catch (Exception $e) {
            Log::error('Error fetching repair record for editing: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to fetch repair record for editing.']);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $repair = Repir::findOrFail($id);
            $repair->product_id = $request->input('product_id');
            $repair->save();

            return redirect()->route('repair.index')->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating product for repair: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update product for repair.']);
        }
    }

}
