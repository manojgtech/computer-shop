<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use App\Models\brandcategory;

class brand extends Model
{
    use HasFactory;

    public function getCategoriesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setCategoriesAttribute($value)
    {
        $this->attributes['categories'] = implode(',', $value);
    }

    public function brandcategories(){

        return $this->hasMany(brandcategory::class,'brand_id','id');
    
    }
}
