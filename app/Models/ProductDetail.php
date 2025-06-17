<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    //
    protected $table = 'product_detail';
    protected $fillable = [
        'product_id',
        'price',
        'size',
        'color',
        'price',
        'prince_sales',
        'quantity',
        'image',];

        public function product()
        {
            return $this->belongsTo(Product::class, 'product_id');
        }
        public function carts()
        {
            return $this->hasMany(Cart::class, 'product_detail_id');
        }

        public function orders()
        {
            return $this->hasMany(Order::class, 'product_detail_id');
        }
        
}
