<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    // public function ProductsByBrand($brandId)
    // {
    //     $brand = Brand::with('products.product_images')->findOrFail($brandId);
    //     return view('pages.brand_products', compact('products'));
    // }
}
