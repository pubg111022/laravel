<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeProduct extends Model
{
    protected $fillable = ['size_id','product_id'];
    public function getName(){
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
    use HasFactory;
}
