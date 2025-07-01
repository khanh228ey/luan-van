<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //


    protected $table = 'vouchers';
    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'reduce',
        'quantity',
        'max',
        'type',
        'status',
        'title',
        'created_at',
        'updated_at',
    ];
}
