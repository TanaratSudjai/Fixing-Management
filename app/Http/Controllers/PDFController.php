<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function Gpdf(Request $req)
    {
        $employee_report = User::latest()->where('status', 2)->paginate(30);

        if ($req->has('download')) {
            $pdf_report = PDF::loadView('pdf-customer', compact('employee_report'))->setOption(['defualtFont' => 'san-serif']);
            return $pdf_report->download('report.pdf');
        }
        return view('employee.employeeview', compact('employee_report'));
    }


    public function Ppdf(Request $req)
    {
        $product_report = Product::latest()->paginate(30);

        if ($req->has('download')) {
            $pdf_content = PDF::loadView('pdf-product', compact('product_report'))->setOption(['defualtFont' => 'san-serif']);
            return $pdf_content->download('report.pdf');
        }
        return view('products..productview', compact('product_report'));
    }

}
