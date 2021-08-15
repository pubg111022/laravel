<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','status'];
    use HasFactory;
    function add($req){
        $addCategory =  Category::create([
            'name'=>$req->name,
            'status'=>$req->status
        ]);        
    }
    function index(){
        return Category::get();
    }
    function count_category($id){
        return Product::where('category_id',$id)->count();
    }
}
