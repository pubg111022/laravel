<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\imageProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\SizeProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::orderBy('id','desc')->get();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::get();
        $size = Size::get();
        $brand = Brand::get();
        return view('admin.product.add', compact('category', 'size','brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $req, Product $product)
    {
        $add = $product->add($req);
        return redirect()->route('product.index');
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
        $product = Product::find($id);
        return view('admin.product.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $old_size = SizeProduct::where('product_id', $id)->pluck('size_id')->toArray();
        $old_product =  Product::where('id', $id)->first();
        $desImg = imageProduct::where("product_id", $id)->get();
        $size = Size::get();
        $category = Category::get();
        $brand = Brand::get();
        return view('admin.product.edit',compact('old_product', 'category', 'desImg', 'size', 'old_size','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $req, $id)
    {
        SizeProduct::where("product_id", $id)->delete();
        if ($req->has('size')) {
            foreach ($req->size as $key => $value) {
                SizeProduct::create([
                    'size_id' => $value,
                    'product_id' => $id
                ]);
            }
        }
        $req->validate(
            [
                'name' => 'required|max:255',
                'price' => 'required',
                'sale_price' => 'lt:price',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Name is not null',
                'name.max' => 'The name must not be greater than 255 characters',
                'price.required' => 'Price is not null',
                'sale_price.max' => 'Sale price must not be greater than Price',
                'category_id.required' => 'Category is not null',
            ]
        );
        if ($req->has('files')) {
            if ($req->ima != null) {
                foreach ($req->ima as $key => $value) {
                    imageProduct::find($value)->delete();
                }
                foreach ($req->files as $key => $value) {
                    foreach ($value as $key2 => $value2) {
                        $value2->move(public_path('uploads'), $value2->getClientOriginalName());
                        $listImg = imageProduct::create([
                            'product_id' => $id,
                            'image' => $value2->getClientOriginalName()
                        ]);
                    };
                }
            } else {
                foreach ($req->files as $key => $value) {
                    foreach ($value as $key2 => $value2) {
                        $value2->move(public_path('uploads'), $value2->getClientOriginalName());
                        $listImg = imageProduct::create([
                            'product_id' => $id,
                            'image' => $value2->getClientOriginalName()
                        ]);
                    };
                }
            }
        }
        $old_product =  Product::where('id', $id)->first();
        $file_name = $old_product->image;
        if ($req->has('file')) {
            $file =  $req->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }
        $old_product->update(
            [
                'name' => $req->name,
                'image' => $file_name,
                'price' => $req->price,
                'sale_price' => $req->sale_price,
                'category_id' => $req->category_id,
                'brand_id'=>$req->brand_id,
                'status' => $req->status,
                'description' => $req->description
            ]
        );
        $alert = "Successful Update";
        return redirect()->route('product.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        imageProduct::where('product_id', $id)->delete();
        SizeProduct::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect()->route('product.index');
    }
}
