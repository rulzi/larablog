<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post as Post;

class adminPostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        $data = ['posts' => $posts];

        return view('adminpage.post.post', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpage.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = new Post;

        $post->title = $request->title;
        $post->slug = $post->getSlug($request->title);
        $post->content = $request->content;
        $post->status = $request->status;
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $destinationPath = "images";
            $filename=$file->getClientOriginalName();
            $request->file('file')->move($destinationPath, $filename);
            $post->file = $filename;
        }

        $post->save();

        $request->session()->flash('add_success', 'Post successfully added!');

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
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $data = ['post' => $post];

        return view('adminpage.post.edit', $data);
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = $post->getSlug($request->title);
        $post->content = $request->content;
        $post->status = $request->status;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $destinationPath = "images";
            $filename=$file->getClientOriginalName();
            $request->file('file')->move($destinationPath, $filename);
            $post->file = $filename;
        }

        $post->save();

        $request->session()->flash('edit_success', 'Post successfully edited!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);

        $post->delete();

        $request->session()->flash('delete_success', 'Post successfully deleted!');

        return redirect()->back();
    }
}
