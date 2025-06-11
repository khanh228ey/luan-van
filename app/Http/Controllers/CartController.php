<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function addCart(Request $request)
    {
        // Logic to add item to cart
        return response()->json(['message' => 'Item added to cart successfully']);
    }
}
