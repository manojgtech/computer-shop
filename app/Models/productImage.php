<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class productImage extends Model
{
    use HasFactory;
    protected $table="product_images1";
    protected $fillable=['image','product_id'];
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
