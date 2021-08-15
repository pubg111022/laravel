<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Config::get();
        return view('admin.config.index', compact('config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.config.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfigRequest $request)
    {
        if ($request->has('content')) {
            $content = $request->content;
        } else if ($request->has('text')) {
            $content = $request->text;
        };
        if ($request->has('file')) {
            $file =  $request->file;
            $content = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $content);
        }
        Config::create([
            'name' => $request->name,
            'content' => $content,
            'status' => $request->status,
            'type' => $request->type
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
        $config = Config::find($id);
        return view('admin.config.edit', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfigRequest $request, $id)
    {
        $config = Config::find($id);
        if ($request->type == 'text') {
            if ($request->has('content')) {
                $content = $request->content;
            } else if ($request->has('text')) {
                $content = $request->text;
            };
        }
        if($request->type=='file'){
            if ($request->has('file')) {
                $file =  $request->file;
                $content = $file->getClientOriginalName();
                $file->move(public_path('uploads'), $content);
            }else{
                $content = $config->content;
            }
        }
        $config->update([
            'content'=>$content,
            'name'=>$request->name,
            'type'=>$request->type
        ]);
        return redirect()->route('config.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Config::find($id)->delete();
        return redirect()->back();
    }
}
