<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['name', 'image', 'price', 'sale_price', 'status', 'category_id','description','brand_id'];
    function add($req){
        $file_name = '';
        if($req->has('file')){
            $file =  $req->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }
        $add = Product::create([
            'name'=>$req->name,
            'image'=>$file_name,
            'price'=>$req->price,
            'sale_price'=>$req->sale_price,
            'category_id'=>$req->category_id,
            'brand_id'=>$req->brand_id,
            'status'=>$req->status,
            'description'=>$req->description
        ]);
        if ($req->has('files')) {
            foreach ($req->files as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    $value2->move(public_path('uploads'), $value2->getClientOriginalName());
                    $listImg = imageProduct::create([
                        'product_id' => $add->id,
                        'image' => $value2->getClientOriginalName()
                    ]);
                };
            }
        }
        if ($req->size == null) {
            $size = Size::get();
            $siz = 0;
            foreach($size as $value){
                $siz = $value->id;
            }
            $addsize = SizeProduct::create(
                [
                    'size_id' => $siz,
                    'product_id' => $add->id
                ]
            );
        } else {
            foreach ($req->size as $key => $value) {
                $addsize = SizeProduct::create(
                    [
                        'size_id' => $value,
                        'product_id' => $add->id
                    ]
                );
            }
        }
    }
    function top3(){
        return DB::table('products')->where('status',0)->take(3)->get();
    }
    function last3(){
        return DB::table('products')->where('status',0)->skip(3)->take(3)->get();
    }
    function getProByCate($id){
        if($id==null || $id == 0){
            $product = Product::paginate(6);
        }else{
            $product = Product::where('category_id',$id)->paginate(6);
        }
        return $product;
    }
    function getProByPrice($price){
        $data = explode(',', $price);
        return Product::whereBetween('price', [$data[0],$data[1]])->paginate(6);
    }
    function sort($type){
        if($type == "new" || $type == null){
            return Product::orderBy('id','desc')->paginate(6);
        }else if($type == "asc"){
            return Product::orderBy('name','asc')->paginate(6);
        }else if($type == "desc"){
            return Product::orderBy('name','desc')->paginate(6);
        }else if ($type == "up"){
            return Product::orderBy('price','asc')->paginate(6);
        }else{
            return Product::orderBy('price','desc')->paginate(6);
        }
    }
    function search($keyword){
        return Product::where('name','like',"%".$keyword."%")->paginate(6);
    }
    function getbyid($id){
        return Product::find($id);
    }
    function productRelated($id){
        return Product::where('category_id',$id)->get();
    }
    function getImage($id){
        $img = imageProduct::where('product_id',$id)->get();
        return $img;
    }
    function getStar($id){
        $value = 0;
        $count = 0;
        $star = 0;
        $review = Review::where('product_id',$id)->get();
        $count = Review::where('product_id',$id)->count();
        foreach($review as $item){
            $star += $item->rating;
        }
        if($count==0){
            $value = 0;
        }else{
            $value = $star/$count;
        }
        return $value;
    }
    function getCateName($id){
        return Category::find($id);
    }
    function countProduct($id){
        return Product::where('category_id',$id)->count();
    }
    use HasFactory;
}
