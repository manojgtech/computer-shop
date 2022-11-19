<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\brand;

class brandcategory extends Model
{
    use HasFactory;
    protected $table="brand_categories";
    protected $fillable=['parent_id','brand_id','name','slug'];

    public function parent()
    {
        return $this->belongsTo(brandcategory::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id','id');
    }

    public function brand()
    {
        return $this->hasOne(brand::class, 'id','brand_id');
    }
}
