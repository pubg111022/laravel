<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\imageProduct;
use App\Models\Product;
use App\Models\SizeProduct;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $list_category = $category->index();
        return view('admin.category.index',compact('list_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category , CategoryRequest $req)
    {
        $add = $category->add($req);
        return redirect()->route('category.index');
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
        $old = Category::find($id);
        return view('admin.category.edit',compact('old'));
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
                'name' => 'required|max:255|unique:categories,name,'.$id
            ],
            [
                'name.required' => "Name Category Not Null",
                'name.max' => "The name must not be greater than 255 characters.",
                'name.unique'=>"Name is exited"
            ]
        );
        $update = Category::find($id)->update([
            'name'=>$req->name,
            'status'=>$req->status
        ]);
        return redirect()->route('category.index');
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

        $product = Product::where('category_id',$id)->get();
        foreach ($product as $key => $value) {
            SizeProduct::where('product_id',$value->id)->delete();
            imageProduct::where('product_id',$value->id)->delete();
            Wishlist::where('product_id',$value->id)->delete();
            Cart::where('product_id',$value->id)->delete();
        }
        Product::where('category_id',$id)->delete();
        $removeCategory = Category::find($id)->delete();
        return redirect()->back();
    }
}
