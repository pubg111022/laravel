<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable = ['name','status','price'];
    function getName($id){
        return ShippingMethod::find($id)->name;
    }
    use HasFactory;
}
