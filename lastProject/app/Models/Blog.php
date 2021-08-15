<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['id','title','banner','content'];
    function countComment($id){
        return Comment::where('blog_id',$id)->count();
    }
    function countRep($id){
        return 0;
    }
    use HasFactory;
}
