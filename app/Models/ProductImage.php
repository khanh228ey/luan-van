<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //  
    protected $table = 'product_image';
    protected $fillable = [
        'product_id',
        'image1',
        'image2',
        'image3',
        'image4',
        'created_at',
        'updated_at',];

}
