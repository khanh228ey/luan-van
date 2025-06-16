<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function addCart(Request $request)
    {
        $data = $request->all();
        //no seesion
        

    }

    public function viewCart()
    {
        return view('pages.cart');
    }
}
