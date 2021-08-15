<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmerRequest;
use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farmer =Farmer::get();
        return view('admin.farmer.index',compact('farmer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.farmer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FarmerRequest $request)
    {
        if ($request->has('file')) {
            $file =  $request->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }
        $farmer = Farmer::create(
            [
                'name' => $request->name,
                'avatar' => $file_name,
                'role' => $request->role
            ]
        );
        return redirect()->route('farmer.index');
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
        $old_farmer = Farmer::find($id);
        return view('admin.farmer.edit',compact('old_farmer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FarmerRequest $request, $id)
    {
        $old_farmer = Farmer::find($id);
        if ($request->has('file')) {
            $file =  $request->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        } else {
            $file_name = $old_farmer->avatar;
        }
        $update_farmer = Farmer::find($id)->update([
            'name' => $request->name,
            'avatar' => $file_name,
            'role' => $request->role
        ]);
        return redirect()->route('farmer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Farmer::find($id)->delete();
        return redirect()->back();
    }
}
