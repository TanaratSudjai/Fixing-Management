<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Repir;
use App\Models\Status;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class RepirController extends Controller
{
    public function RepirList(Request $req)
    {
        try {
            $customerId = auth()->id();
            $repairs = Repir::with('customer', 'status')
                ->where('customer_id', $customerId)
                ->get();

            return view('repir.listRepait', compact('repairs'));


        } catch (Exception $e) {
            Log::error('Error fetching repair list: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to fetch repair records.']);
        }
    }

    public function AddRepir(Request $req)
    {
        try {
            $validatedData = $req->validate([
                'repair_detail' => 'required|string',
            ]);

            $customerId = Auth::id();
            Repir::create([
                'customer_id' => $customerId,
                'repair_detail' => $validatedData['repair_detail'],
                'employee_id' => null,
                'product_id' => null,
                'status_id' => 1,
            ]);

            return redirect()->route('customer.dashboard')->with('success', 'Repair record created successfully.');
        } catch (\Illuminate\Database\QueryException $e) {

            Log::error('Database Query Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Database query error: ' . $e->getMessage()]);
        } catch (Exception $e) {

            Log::error('Error creating repair record: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create repair record.']);
        }
    }

    public function editRepir($id)
    {
        $repair = Repir::findOrFail($id);

        return view('repairs.edit', compact('repair'));
    }

    public function updateRepir(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'repair_detail' => 'required|string',
            ]);

            $repair = Repir::findOrFail($id);

            $repair->update([
                'repair_detail' => $validatedData['repair_detail'],
            ]);

            return redirect()->route('repairs.index')->with('success', 'Repair record updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating repair record: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update repair record.']);
        }
    }
    public function edit($id)
    {
        $repair = Repir::findOrFail($id);
        return view('repir.editRepir', compact('repair'));
    }
    public function update(Request $request, $id)
    {
        $repair = Repir::findOrFail($id);
        if ($repair->status_id == 0) {
            $request->validate([
                'repair_detail' => 'required|string|max:255',
            ]);
            $repair->repair_detail = $request->input('repair_detail');
            $repair->save();
        } else {
            return redirect()->back()->withErrors(['error' => 'รายการนี้ไม่สามารถแก้ไขได้เพราะรับเเจ้งไปแล้ว']);
        }

        return redirect()->route('repairs.list')->with('success', 'Repair updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $repair = Repir::findOrFail($id);
            $repair->delete();

            return redirect()->route('repairs.index')->with('success', 'Repair record deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting repair record: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to delete repair record.']);
        }
    }
}
