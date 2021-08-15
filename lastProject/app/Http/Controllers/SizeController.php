<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Models\Cart;
use App\Models\imageProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\SizeProduct;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size = Size::get();
        return view('admin.size.index',compact('size'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.add');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $req , Size $size)
    {
        $add = $size->add($req);
        return redirect()->route('size.index');
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
        //
        $old_size = Size::find($id);
        return view('admin.size.edit',compact('old_size'));
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
                'name' => 'unique:sizes,name,'.$id
            ],
            [
                'name.unique'=>"Name is exited"
            ]
        );
        $update = Size::find($id)->update([
            'name'=>$req->name
        ]);
        return redirect()->route('size.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SizeProduct::where('size_id',$id)->delete();
        Size::find($id)->delete();
        return redirect()->back();
    }
}
