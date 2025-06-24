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
        'district', // sửa đúng là 'district', không phải 'distrist'
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
        return $this->belongsToMany(ProductDetail::class, 'order_product', 'order_id', 'product_detail_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

public function getTotalAttribute()
{
    return $this->orderItems->sum(function ($item) {
        return $item->productDetail->price_sales * $item->quantity;
    });
}
}
