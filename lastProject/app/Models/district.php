<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $fillable = ['maqh','name','type','matp'];
    use HasFactory;
}
