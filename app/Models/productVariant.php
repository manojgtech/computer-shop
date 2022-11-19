<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\property;
use App\Models\product;
use App\Models\productVariantOptions;

class productVariant extends Model
{
    use HasFactory;
    protected $table="product_variants";
    public $timestamps = false;

    
    public function vproperty()
    {
        return $this->hasOne(productVariantOptions::class,'id','variant');
    }
}
