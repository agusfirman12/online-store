<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function cart_detiles(){
        return $this->hasMany(CartDetile::class);
    }
}
