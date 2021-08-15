<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','name','email','shipping_method_id','payment_methods','phone','address','note','shipping_status','quantity','order_status', 'total'];
    use HasFactory;
}
