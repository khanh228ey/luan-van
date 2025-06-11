<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //


    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'brand_id',
        'created_at',
        'updated_at',
    ];
  
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function carts()

    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'product_id', 'cart_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    public function orders()

    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
                    ->withPivot('quantity' )
                    ->withTimestamps();
    }
    public function product_images()
{
    return $this->hasOne(ProductImage::class, 'product_id');
}

    public function product_details()
    {
        return $this->hasMany(ProductDetail::class, 'product_id');
    }
}
