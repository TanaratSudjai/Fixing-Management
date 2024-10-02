<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function adminPageAddEmployee(){
        return view('formAddEmployee');
    }

    public function adminPageAddProduct(){
        return view('formAddProduct');
    }

    public function PageCustomer(){
        return view('cutomerview');
    }

    public function PageEmployee(){
        return view('activeEmployee');
    }

    public function PageAddRepirCustomer(){
        return view('repir.formRepir');
    }

    
}
