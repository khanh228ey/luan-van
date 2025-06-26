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
        public function product_images()
        {
            // Nếu ProductImage có product_id, ProductDetail cũng có product_id,
            // thì quan hệ này sẽ trả về ảnh của sản phẩm cha, không phải riêng cho từng ProductDetail.
            // Nếu muốn lấy ảnh theo từng ProductDetail, ProductImage nên có product_detail_id.
            // Nếu vẫn muốn lấy ảnh theo product_id, quan hệ này đúng, nhưng sẽ trả về ảnh chung cho sản phẩm.
            return $this->hasOne(ProductImage::class, 'product_id', 'product_id');
        }
        
}
