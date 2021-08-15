<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name','logo','status'];
    function addBrand($req){
        $file_name = '';
        if($req->has('file')){
            $file =  $req->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }
        Brand::create([
            'name'=>$req->name,
            'status'=>$req->status,
            'logo'=>$file_name
        ]);
    }
    use HasFactory;
}
