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
            "posts" => Post::all()
            // ->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
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
