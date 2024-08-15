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
        $employee = auth()->id();
        $workrepair = Repir::with('customer', 'status')
            ->where('employee_id', $employee)
            ->where('status_id', 1)
            ->get();

        $inprogress = Repir::with('customer', 'status')
            ->where('employee_id', $employee)
            ->where('status_id', 2)
            ->get();

        return view('work.work', compact('workrepair', 'inprogress'));
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

    public function statuswarning($id)
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
            $selectedProductId = $request->input('product_id');
            $unitAmounts = $request->input('unit_amount');

            $product = Product::findOrFail($selectedProductId);
            if ($repair->product_id == null) {
                $repair->product_id = $selectedProductId;
                $repair->unit_amount = $unitAmounts[$selectedProductId];
                $product = Product::findOrFail($selectedProductId);

            } else {
                $repair->status = 2;
            }

            $repair->save();
            return $product ;
            //return redirect()->route('employee.work')->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating product for repair: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update product for repair.']);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $repair = Repir::findOrFail($id);
            $repair->status_id = $request->input('status_id');
            $repair->save();

            return redirect()->route('employee.work')->with('status', 'Repair status updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating repair status: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update repair status.']);
        }
    }

    public function done(Request $request, $id)
    {
        try {
            $repair = Repir::findOrFail($id);
            $repair->status_id = $request->input('status_id');
            $repair->save();

            return redirect()->route('employee.work')->with('status', 'Repair status updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating repair status: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update repair status.']);
        }
    }

}
