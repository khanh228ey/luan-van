<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\category;
use App\Models\Product;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index()
    {
        $products= Product::orderBy('created_at', 'asc')
            ->limit(4)
            ->get();
        $brand1 = Brand::orderBy('created_at', 'asc')
            ->limit(1)
            ->first();
        $brand2 = Brand::orderBy('created_at', 'asc')
            ->where('id', '!=', $brand1->id)
            ->limit(1)
            ->first();
        $product = Product::with('brand')
            ->orderBy('created_at', 'desc')
            ->first();
        return view('pages.home', compact('products', 'brand1', 'brand2', 'product'));

    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $brands = Brand::limit(6)->get();
        $categories = category::limit(6)->get();
        $products = Product::where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhereHas('category', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('brand', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        // if ($products->isEmpty()) {
        //     Toastr::error('No products found for your search query.');
        // }

        return view('pages.search', compact('products', 'brands', 'categories', 'search'));
    }

}
