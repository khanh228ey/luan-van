<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $category = category::with('products')
            ->orderBy('created_at', 'asc')
            ->limit(4)
            ->get();
        $products= Product::orderBy('created_at', 'asc')
            ->limit(4)
            ->get();
        return view('pages.home', compact('category','products'));
    
    }

}
