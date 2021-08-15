<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepComment extends Model
{
    protected $fillable = ['id','comment_id','reply','user_id'];
    function getRepName(){
        return $this->belongsTo(User::class,'user_id','id');
    }
  
    use HasFactory;
}
