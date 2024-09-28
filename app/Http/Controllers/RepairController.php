<?php

namespace App\Http\Controllers;

use App\Models\Repir;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class RepairController extends Controller
{
    public function search(Request $request)
    {
        Log::info('Search Params', [
            'employee' => $request->employee,
            'customer' => $request->customer,
            'detail' => $request->detail,
        ]);

        $query = Repir::query();

        if ($request->employee) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . strtolower($request->employee) . '%');
            });
        }

        if ($request->customer) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . strtolower($request->customer) . '%');
            });
        }

        if ($request->detail) {
            $query->where('repair_detail', 'like', '%' . strtolower($request->detail) . '%');
        }

        $repairs = $query->get();

        // Render the partial view with the filtered repairs
        return view('admin.table', compact('repairs'))->render();
    }
}
