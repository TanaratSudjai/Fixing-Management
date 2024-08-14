<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repir;

class EmployeeManagement extends Controller
{
    //
    public function listwork()
    {
        $workrepair = Repir::all();

        return view('work.work', compact('workrepair'));
    }
}
