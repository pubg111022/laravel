<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name'];
   
    function add($req){
        Size::create([
            'name'=>$req->name
        ]);
    }
    use HasFactory;
}
