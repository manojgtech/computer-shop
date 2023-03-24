<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class property extends Model
{
    use HasFactory;
    protected $table="proprties";
    protected $fillable=['property_name',"property_value","product_id",'group_heading'];

    public function product()
    {
        return $this->belongsTo(product::class,'product_id');
    }
}
