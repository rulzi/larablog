<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post as Post;
use Mail;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::paginate(2);

        $data = [
            'posts' => $posts,
            'nextpage' => $posts->nextPageUrl(),
            'prevpage' => $posts->previousPageUrl()
            ];

        return view('home', $data);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        $data = ['post' => $post];

        return view('show', $data);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {

        $this->validate($request, [
            'nama' => 'required|max:255',
            'email' => 'required',
            'message' => 'required'
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->message,
        ];

        Mail::send('email', $data, function ($message) {
           $message->to('science.afandi@gmail.com', 'Afandi')->subject('Afandi Blog');
           $message->sender('blog.afandi@gmail.com', 'blog afandi');
        });

        $request->session()->flash('add_success', 'Email Sended!');

        return redirect()->back();
    }
}
