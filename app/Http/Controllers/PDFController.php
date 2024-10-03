<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use SVG\Tag\Rect;

use App\Models\User;
use App\Models\Repir;
use App\Models\Product;


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

    public function bill_pdf(Request $req, $id)
    {
        // Fetch the repair record using the provided ID
        $receipt = Repir::findOrFail($id);

        // Fetch the associated product using the `product_id` in `Repir`
        $product = Product::find($receipt->product_id);
        $user = User::find($receipt->customer_id);

        // Calculate the total price for the product
        $total_price = $product->product_price * $receipt->unit_amount;

        // Store product details in a collection for use in the view/PDF
        $productData = [
            'product_name' => $product->product_name,
            'product_qty'  => $receipt->unit_amount,
            'product_price' => $product->product_price,
            'total_price'  => $total_price,
            'user' => $user->name
        ];

        // If 'download' is passed in the request, generate the PDF
        if ($req->has('download')) {
            $pdf = PDF::loadView('pdf-receipt', compact('productData', 'receipt'))
                ->setOption(['default_font' => 'THSarabunNew']);
            return $pdf->download('receipt.pdf');
        }

        // If not downloading, return the view to display the product details
        return view('work.work', compact('productData', 'receipt'));
    }
}
