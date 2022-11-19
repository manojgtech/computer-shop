<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use App\Models\order;
 use App\Models\product;

class orderItem extends Model
{
    use HasFactory;
    protected $table="orderitems";
    protected $fillable=['order_id','quantity','product_id','itemdata'];
   public  $timestamps=false;

   public function order()
    {
        return $this->belongsTo(order::class, 'order_id');
    }

    public function product()
    {
        return $this->hasOne(product::class, 'id','product_id');
    }
    
    
}
