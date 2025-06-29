<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function listProduct()
    {
        $brands = Brand::limit(6)->get();
        $categories = category::limit(6)->get();
        $products = Product::with('brand', 'product_images')->paginate(12);
        return view('pages.list_product', compact('products', 'brands', 'categories'));
    }
    public function productDetail($productId)
    {
        $product = Product::with('brand', 'product_images', 'product_details')->findOrFail($productId);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $productId)
            ->with('brand', 'product_images')
            ->take(4)
            ->get();
        return view('pages.product_detail', compact('product', 'relatedProducts'));
    }

    public function listProductByCategory($categoryId)
    {
        $brands = Brand::limit(6)->get();
        $categories = category::where('id', '!=', $categoryId)->limit(6)->get();
        $products = Product::with('brand', 'product_images')
            ->where('category_id', $categoryId)
            ->paginate(12);
        return view('pages.list_product', compact('products', 'brands', 'categories'))
            ->with('currentCategoryId', $categoryId);
    }
    public function listProductByBrand($brandId)
    {
        $brands = Brand::where('id', '!=', $brandId)->limit(6)->get();
        $categories = category::limit(6)->get();
        $products = Product::with('brand', 'product_images')
            ->where('brand_id', $brandId)
            ->paginate(12);
        return view('pages.list_product', compact('products', 'brands', 'categories'))
            ->with('currentBrandId', $brandId);
    }
    public function filterByPrice(Request $request)
    {
        $min = $request->input('min_price', 0);
        $max = $request->input('max_price', 10000000); // giới hạn tối đa

        $products = Product::with('product_images')
            ->whereBetween('price', [$min, $max])
            ->paginate(12);
        $categories = category::all();
        $brands = Brand::all();
     
        return view('pages.list_product', compact('products', 'categories', 'brands'));
    }
}
