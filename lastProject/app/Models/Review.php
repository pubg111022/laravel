<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable=['reviews','rating','product_id','user_id'];
    use HasFactory;
    public function getName(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
