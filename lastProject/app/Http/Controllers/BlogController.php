<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\RepComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::get();
        return view('admin.blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        if ($request->has('file')) {
            $file =  $request->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }
        $blog = Blog::create(
            [
                'title' => $request->title,
                'banner' => $file_name,
                'content' => $request->content
            ]
        );
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.detail',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $old_blog = Blog::find($id);
        return view('admin.blog.edit', compact('old_blog'));
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
                'title' => 'required',
                'content'=>'required'
            ],
            [
                'name.required' => "Title Not Null",
                'content.required' => "Content Not Null",
            ]
        );
        $old_blog = Blog::find($id);
        if ($request->has('file')) {
            $file =  $request->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        } else {
            $file_name = $old_blog->banner;
        }
        $update_blog = Blog::find($id)->update([
            'title' => $request->title,
            'banner' => $file_name,
            'content' => $request->content
        ]);
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::where('blog_id', $id)->get();
        foreach ($comment as $value) {
            RepComment::where('comment_id', $value->id)->delete();
        }
        Comment::where('blog_id', $id)->delete();
        $delblog = Blog::find($id)->delete();
        return redirect()->back();
    }
}
