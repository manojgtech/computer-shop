<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable=['id','parent_id','name','slug'];
    public function parent()
    {
        return $this->belongsTo(category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id','id');
    }

    public function brands()
    {
       return $this->hasManyThrough(brand::class, product::class, 'category_id', 'id');
    }
}
