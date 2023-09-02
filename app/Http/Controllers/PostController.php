<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    //
    public function index()
    {  
     
        return view('posts', [
            "title" => "Blogg" ,
            "active" => 'posts',
            "posts" => Post::with('category')->latest()->search()->get()
            
          
        ]);
    }

    public function show(Post $post)
    {
        return view('singlePost', [
            "title" => "Single Post",
            "active" => 'posts',
            "post" => $post
        ]);
    }
}
