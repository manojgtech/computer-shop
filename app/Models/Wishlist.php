<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class Wishlist extends Model
{
    use HasFactory;
 protected $table="wishlist";
 
 public function product()
    {
        return $this->hasOne(product::class,'id',"product_id");
    }
}
