<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {

            $postAdmin = Post::with(['user','category'])->get();
        return view('dashboard.posts', [
            "posts" => $postAdmin->where('user_id', auth()->user()->id),
            "postsAdmin" => $postAdmin,
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
            'author' => 'required',
            'image'=>'image|file|max:6144',
            'category_id' => 'required',
            'body' => 'required|string',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('folder-images');
        }

        $user = Auth::user();


        $validatedData['user_id'] = $user->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success','post telah di tambahkan');
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
            "title" => "show",
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
        return view('dashboard.crud.edit', [
            'title' => 'edit',
            'categories' => Category::all(),
            "post" => $post
            
        ]);
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
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required',
            'category_id' => 'required',
            'body' => 'required|string',
        ];

        if($request->slug != $post->slug){
            $rules['slug']= 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
        $user = Auth::user();


        $validatedData['user_id'] = $user->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Post::where('id',$post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success','post telah di perbaharui');
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