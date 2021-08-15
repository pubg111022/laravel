<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $fillable = ['product_id', 'size_id', 'user_id'];
    use HasFactory;
    function getCart($id)
    {
        return DB::table('carts')->select(
            'products.id as proId',
            'products.name',
            'products.image',
            'products.price',
            'products.sale_price',
            'products.status',
            'products.description',
            'sizes.name as size',
            'sizes.id as sizeid',
            DB::raw('count(products.id) as quantity , sum(products.price) as total1,sum(products.sale_price) as total2')
        )
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'carts.size_id')
            ->groupBy('sizes.name', 'sizes.id', 'products.id', 'products.name', 'products.image', 'products.price', 'products.sale_price', 'products.status', 'products.description')
            ->where('user_id', $id)
            ->get();
    }
    function getCount($id)
    {
        return DB::table('carts')->select(
            'products.id as proId',
            'products.name',
            'products.image',
            'products.price',
            'products.sale_price',
            'products.status',
            'products.description',
            'sizes.name as size',
            'sizes.id as sizeid',
            DB::raw('count(products.id) as quantity , sum(products.price) as total1,sum(products.sale_price) as total2')
        )
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'carts.size_id')
            ->groupBy('sizes.name', 'sizes.id', 'products.id', 'products.name', 'products.image', 'products.price', 'products.sale_price', 'products.status', 'products.description')
            ->where('user_id', $id)
            ->get();
    }
    function getSize($product_id){
        return SizeProduct::where('product_id',$product_id)->get();
    }
}
