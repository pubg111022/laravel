<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Config;
use App\Models\Configuration;
use App\Models\Wishlist;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($quant) {
            if (Auth::check()) {
                $quant->with('quant', with($cart = DB::table('carts')->select(
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
                    ->where('user_id', Auth::user()->id)
                    ->get()->count()));
            } else {
                $quant->with('quant', 0);
            }
        });
        view()->composer('*', function ($list) {
            if (Auth::check()) {
                $list->with('list', with($cart = DB::table('carts')->select(
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
                    ->where('user_id', Auth::user()->id)
                    ->get()));
            } else {
                $list->with('list', []);
            }
        });
        view()->composer('*', function ($countWish) {
            if (Auth::check()) {
                $countWish->with('countWish', with($wish = Wishlist::where('user_id', Auth::user()->id)->count()));
            } else {
                $countWish->with('countWish', 0);
            }
        });
        // $name = Config::where('name','name')->first();
        // $phone = Config::where('name','phone')->first();
        // $address = Config::where('name','address')->first();
        // $email = Config::where('name','email')->first();
        // $logo = Config::where('name','logo')->first();
        $name = Config::where('name','name')->count()==0?'Vegetable':Config::where('name','name')->first()->content;
        $phone = Config::where('name','phone')->count()==0?'0865493620':Config::where('name','phone')->first()->content;
        $address = Config::where('name','address')->count()==0?'Kim No - Dong Anh - Ha Noi':Config::where('name','address')->first()->content;
        $email = Config::where('name','email')->count()==0?'vandat97875@gmail.com':Config::where('name','email')->first()->content;
        $logo = Config::where('name','logo')->count()==0?'logo.png':Config::where('name','logo')->first()->content;
        // $name = 'Vegetable';
        // $phone = '0865493620';
        // $address = 'Dong Anh - Ha Noi';
        // $email = 'vandat97875@gmail.com';
        // $logo = 'logo.png';
        view()->share('name',$name);
        view()->share('phone',$phone);
        view()->share('address',$address);
        view()->share('email',$email);
        view()->share('logo',$logo);
    }
}
