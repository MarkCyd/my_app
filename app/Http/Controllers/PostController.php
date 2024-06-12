<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
//use App\Http\Requests\StorePostRequest;
//use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller Implements HasMiddleware //add implements hasmiddleware 
{
    public static function middleware() //add static or will not work and its an array
    {
        return [
            new Middleware('auth',except:['show','index']), //all of the other route except show and route are auth check
        ];
    }

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
    {                                                     //this will check if the user is equal to user_id
        Gate::authorize('modify',$post); //modify is the class from postpolicy import gate facades
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //authorize user can only access the page
        Gate::authorize('modify',$post);
        //validate
        $fields= $request->validate([
            'title' => 'required','max:15',
            'body' => 'required',
           ]);
           //update
          $post->update($fields); //ignore the red post and its an eloquent syntax
           //use this if has no relationship
           //Post::create(['user_id'=>Auth::id(),...$fields]);
    
           //redirect
           return redirect(route('dashboard'))->with('success', 'Post is updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify',$post);
        /* delete post */
      $post->delete();
      /* redirect to dashboard */
      return back()->with('delete','Post deleted successfully');
    }
}
