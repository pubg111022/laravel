<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::get();
        return view('admin.coupon.index', compact('coupon'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        Coupon::create([
            'code' => $request->code,
            'value' => $request->value,
            'quantity' => $request->quantity,
            'condition' => $request->condition,
            'status' => 0
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
        $old_coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('old_coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $request->validate(
            [
                'code' => 'required|max:255|unique:coupons,code,'.$id,
                'value' => 'required',
                'quantity' => 'required',
                'condition' => 'required'
            ],
            [
                'code.required' => 'code Not Null',
                'code.unique' => 'Code is existed',
                'value.required' => 'value Not Null',
                'quantity.required' => 'quantity Not Null',
                'condition.required' => 'condition Not Null',
            ]
        );
        Coupon::find($id)->update([
            'code' => $request->code,
            'value' => $request->value,
            'quantity' => $request->quantity,
            'condition' => $request->condition,
            'status' => $request->status
        ]);
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return redirect()->back();
    }
}
