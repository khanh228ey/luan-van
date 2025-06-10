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
}
