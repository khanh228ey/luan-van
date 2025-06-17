<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_detail_id',
        'quantity',
        'price',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id');
    }

    
}
