<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Repir;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Mpdf\Mpdf;

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


    public function Ppdf(Request $req)
    {
        $product_report = Product::latest()->paginate(30);

       if ($req->has('download')) {

               $pdf_content = view('pdf-product', compact('product_report'))->render();

               $mpdf = new Mpdf([
                   'default_font' => 'thsarabun'
               ]);

               $mpdf->WriteHTML($pdf_content);

               return $mpdf->Output('report.pdf', \Mpdf\Output\Destination::DOWNLOAD);
           }
        return view('products..productview', compact('product_report'));
    }

}
