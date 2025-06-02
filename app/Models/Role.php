<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    // public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = [
       'name',
       'created_at',
       'updated_at',
    ];



    public function users(){
        return $this->belongsToMany(User::class,'role_id');
    }
    
}
