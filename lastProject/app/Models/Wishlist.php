<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['product_id','user_id'];
    use HasFactory;
    function checkexits($id,$user_id){
        $exits = Wishlist::where('product_id', $id)->where('user_id', $user_id)->count();
        if($exits>0){
            return 1;
        }else{
            return 0;
        }
    }
    public function getProductName(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    function getCount($id){
        return Wishlist::where('user_id',$id)->count();
    }
}
