<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingMethodgRequest;
use App\Models\commune;
use App\Models\DeliveryPrice;
use App\Models\ShippingMethod as ModelsShippingMethod;
use Illuminate\Http\Request;

class ShippingMethod extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = ModelsShippingMethod::get();
        return view('admin.shippingMethod.index',compact('method'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shippingMethod.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingMethodgRequest $request)
    {
        ModelsShippingMethod::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'status'=>$request->status
        ]);
        return redirect()->back();
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
        $method = ModelsShippingMethod::find($id);
        return view('admin.shippingMethod.edit',compact('method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingMethodgRequest $request, $id)
    {
        ModelsShippingMethod::find($id)->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'status'=>$request->status
        ]);
        return redirect()->route('shippingmethod.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ModelsShippingMethod::find($id)->delete();
        return redirect()->back();
    }
}
