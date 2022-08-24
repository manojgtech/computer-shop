<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class deal extends Model
{
    use HasFactory;

    public function productList()
    {
        $ids=$this->products;
        return product::find($ids);
    }

    
    public function getProductsAttribute($value)
    {
        return $v=explode(',', $value);
        
        
    }

    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = implode(',', $value);
    }
}
