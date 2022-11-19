<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardDisks extends Model
{
    use HasFactory;
    protected $table="harddisks";
    public $timestamps=false;
}
