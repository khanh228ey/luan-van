<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $table = 'order_item';
    protected $fillable = [
        'order_id',
       'description',   
        'created_at',
        'updated_at',
        'product_detail_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
public function product()
{
    return $this->belongsTo(Product::class);
}



}
