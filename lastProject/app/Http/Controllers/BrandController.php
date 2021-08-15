<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\imageProduct;
use App\Models\Product;
use App\Models\SizeProduct;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::get();
        return view('admin.brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $req , Brand $brand)
    {
        $add = $brand->addBrand($req);
        return redirect()->back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $old = Brand::find($id);
        return view('admin.brand.edit',compact('old'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $req->validate(
            [
                'name' => 'required|unique:brands|max:255,name,'.$id
            ],
            [
                'name.required' => "Name Category Not Null",
                'name.max' => "The name must not be greater than 255 characters.",
                'name.unique'=>"Name is exited"
            ]
        );
        $brand = Brand::find($id);
        $file_name = '';
        if($req->has('file')){
            $file =  $req->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }else{
            $file_name = $brand->logo;
        }
        $brand->update([
            'name'=>$req->name,
            'logo'=>$file_name,
            'status'=>$req->status
        ]);
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('brand_id',$id)->get();
        foreach ($product as $key => $value) {
            SizeProduct::where('product_id',$value->id)->delete();
            imageProduct::where('product_id',$value->id)->delete();
            Wishlist::where('product_id',$value->id)->delete();
            Cart::where('product_id',$value->id)->delete();
        }
        Product::where('brand_id',$id)->delete();
        Brand::find($id)->delete();
        return redirect()->back();
    }
}
