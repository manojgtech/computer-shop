<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class faq extends Model
{
    use HasFactory;
    protected $fillable=['id','product_id','question','answer'];
    public function product(){
        return $this->hasOne(product::class,'id','product_id');
    }

}
