<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'name',
        'image',
        'description',
        'created_at',
        'updated_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
