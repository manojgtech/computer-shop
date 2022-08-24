<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    public function parent()
    {
        return $this->belongsTo(category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(category::class, 'parent_id');
    }
}
