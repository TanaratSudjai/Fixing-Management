<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use SVG\Tag\Rect;

class PDFController extends Controller
{

    public function Gpdf(Request $req)
    {
        $customet_report = User::latest()->where('status', 2)->paginate(30);

        if ($req->has('download')) {
            $pdf_report = PDF::loadView('pdf-customer', compact('customet_report'))
                ->setOption(['default_font' => 'THSarabunNew']); // Use the correct font name
            return $pdf_report->download('report.pdf');
        }
        return view('employee.employeeview', compact('customet_report'));
    }

}
