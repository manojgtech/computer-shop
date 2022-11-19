<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Processor;
use App\Models\Ram;
use App\Models\Graphics;
use App\Models\HardDisks;
use App\Models\wifi;
use App\Models\productImage;

class PreownedPC extends Model
{
    use HasFactory;
    protected $table="preproducts";

    public function processor_id()
    {
        return $this->hasOne(Processor::class, 'id');
    }
    public function images(){
      return $this->hasMany(productImage::class,'product_id','id');
    }

    // public function ram()
    // {
    //     return $this->hasOne(Ram::class, 'id','ram');
    // }
    // public function hardisk()
    // {
    //     return $this->hasOne(HardDisks::class, 'id','hdd');
    // }
    // public function graphic()
    // {
    //     return $this->hasOne(Graphics::class, 'id','graphics');
    // }
}
