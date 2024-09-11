<?php

namespace App\Http\Controllers;

use App\Models\Repir;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{

    public function Gpdf(Request $req)
    {
        $customet_report = User::latest()->where('status', 2)->paginate(30);

        if ($req->has('download')) {
            $pdf_report = PDF::loadView('pdf-customer', compact('customet_report'))->setOption(['defualtFont' => 'san-serif']);
            return $pdf_report->download('report.pdf');
        }
        return view('employee.employeeview', compact('customet_report'));
    }

}
