<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use App\Models\brand;
use App\Models\property;
use App\Models\poroductImage;
use App\Models\poroductSeries;

class product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->hasOne(category::class,'id',"category_id");
    }
    public function brand()
    {
        return $this->hasOne(brand::class,'id','brand_id');
    }
    public function property()
    {
        return $this->hasMany(property::class,'product_id');
    }
    public function series()
    {
        return $this->hasOne(poroductSeries::class,'id','series_id');
    }
    public function images(){
        return $this->hasMany(poroductImage::class);
    }
    public function pimage(){
        return $this->hasOne(poroductImage::class)->latest();
    }

    
}
