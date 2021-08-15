<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id','size_product_id','price','name','image'];
    use HasFactory;
    function getPro($id){
        $size_product = SizeProduct::find('id',$id);
        return OrderDetail::where('product_id',$size_product->product_id)->first();
    }
    function getTotalInMonth($month){
        $time = getdate();
        $year = $time["year"];
        $start = $year . '-' . $month-1 . '-' . '31';
        $end = $year . '-' . $month+1 . '-' . '1';
        $total = 0;
        $order =  Order::whereBetween('created_at', [$start, $end])->get();
        foreach ($order as $key => $value) {
           $total += $value->total;
        }
        return $total;
    }
}
