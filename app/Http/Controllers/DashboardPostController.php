<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.posts', [
            "posts" => Post::where('user_id', auth()->user()->id)->get(),
            "title" => "dashboard ",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.crud.create', [
            'title' => 'create',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string',
        ]);

        $user = Auth::user();


        $user_id = $user->id;
        $author = $user->name;


        $excerpt = Str::limit(strip_tags($validatedData['body']), 200);


        $post = new Post([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'category_id' => $validatedData['category_id'],
            'body' => $validatedData['body'],
            'user_id' => $user_id,
            'excerpt' => $excerpt,
            'author' => $author,
        ]);
        $post->save();


        session()->flash('success', 'Pesan berhasil dikirim dan disimpan!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.crud.show', [
            "title" => "halaman dashboard",
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('posts.index')
                     ->with('success', 'Post has been deleted successfully');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}