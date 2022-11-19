<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\address;
use App\Models\orderItem;
use App\Models\Payment;

class order extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->hasOne(User::class, 'id','customer_id');
    }

    // public function address()
    // {
    //     return $this->hasOne(address::class, 'order_id');
    // }

     public function items()
    {
        return $this->hasMany(orderItem::class, 'order_id');
    }

     public function payment()
    {
        return $this->hasOne(payment::class, 'order_id');
    }
    
}
