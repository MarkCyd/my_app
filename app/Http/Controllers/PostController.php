<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Http\Requests\StorePostRequest;
//use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       //validate
       $fields= $request->validate([
        'title' => 'required','max:15',
        'body' => 'required',
       ]);
       //create
       Auth::user()->posts()->create($fields); //ignore the red post and its an eloquent syntax
       //use this if has no relationship
       //Post::create(['user_id'=>Auth::id(),...$fields]);

       //redirect
       return back()->with('success', 'Post is created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        /* delete post */
      $post->delete();
      /* redirect to dashboard */
      return back()->with('delete','Post deleted successfully');
    }
}
