<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['id','comment','blog_id','user_id','status'];
    public function RepComment(){
        return $this->belongsTo(RepComment::class,'id','comment_id');
    }
    // public function getBlogName(){
    //     return $this->belongsTo(Blog::class,'blog_id','id');
    // }
    function getBlogName(){
        return $this->belongsTo(Blog::class,'blog_id','id');
    }
    public function getName(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    use HasFactory;
}
