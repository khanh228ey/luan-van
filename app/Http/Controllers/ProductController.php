<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function listProduct(){
        $brands = Brand::limit(6)->get();
        $categories = category::limit(6)->get();
        $products = Product::with('brand', 'product_images')->paginate(12);
        return view('pages.list_product', compact('products', 'brands', 'categories'));
    }
    public function productDetail($productId){
        $product = Product::with('brand', 'product_images', 'product_details')->findOrFail($productId);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $productId)
            ->with('brand', 'product_images')
            ->take(4)
            ->get();
        return view('pages.product_detail', compact('product', 'relatedProducts'));
    }

}
