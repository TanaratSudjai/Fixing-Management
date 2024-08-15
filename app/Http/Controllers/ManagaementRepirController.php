<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repir;
use App\Models\Status;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\User;

class ManagaementRepirController extends Controller
{
    //
    public function RepirList(Request $req)
    {
        try {
            $repairs = Repir::with('customer', 'employee', 'product', 'status')->get();
            return view('admin.listRepaitforadmin', compact('repairs'));
        } catch (Exception $e) {
            Log::error('Error fetching repair list: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to fetch repair records.']);
        }
    }

    public function selectemployee($id)
    {
        try {
            $repair = Repir::findOrFail($id);

            $employees = User::where('status', 2)->get();

            return view('admin.edit-repair', compact('repair', 'employees'));
        } catch (Exception $e) {
            Log::error('Error fetching repair record for editing: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to fetch repair record for editing.']);
        }
    }



    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'repair_detail' => 'required|string',
                'employee_id' => 'nullable|exists:users,id',
            ]);

            $repair = Repir::findOrFail($id);
            $repair->repair_detail = $validatedData['repair_detail'];
            $repair->employee_id = $validatedData['employee_id'] ?? null;
            $repair->status_id = 1;
            $repair->save();

            return redirect()->route('customer.repir')->with('success', 'Repair record updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating repair record: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update repair record.']);
        }
    }
}
