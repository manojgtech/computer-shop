<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productVariantOptions extends Model
{
    use HasFactory;
    protected $table="variant";
    public $timestamps = false;
    protected $fillable=['product_id','attribute_name','attribute_value','sku','regular_price','sell_price','stock','defaultpic'];

    public function product()
    {
        return $this->belongsTo(category::class, 'parent_id');
    }
}
