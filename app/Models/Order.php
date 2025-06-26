<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status',
        'payment_method',
        'payment_status',
        'total',
        'province',
        'district',
        'ward',
        'detail',
        'note',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products()
    {
        // Quan hệ nhiều-nhiều qua bảng order_items, lấy thêm các trường phụ như size, quantity, price
        return $this->belongsToMany(
            ProductDetail::class,
            'order_item',
            'order_id',
            'product_detail_id'
        )->withPivot( 'quantity');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    // public function getTotalAttribute()
    // {
    //     return $this->orderItems->sum(function ($item) {
    //         return $item->productDetail->price_sales * $item->quantity;
    //     });
    // }
}
