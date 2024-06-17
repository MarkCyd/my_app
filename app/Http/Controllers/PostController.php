<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

//use App\Http\Requests\StorePostRequest;
//use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller Implements HasMiddleware //add implements hasmiddleware 
{
    public static function middleware() //add static or will not work and its an array
    {
        return [
            new Middleware(['auth','verified'],except:['show','index']), //all of the other route except show and route are auth check
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
        'title' => ['required','max:15'],
        'body' => ['required'],
        'image' => ['nullable', 'file','max:1000','mimes:png,jpeg,jpg,webp'],
    ]);

       /* store upload */
        $path=null;
       if($request->hasFile('image'))
        {       //doing this need to run php artisan storage:link to make a link the only public area to the storage public area
        $path = Storage::disk('public')->put('posts_images',$request->image);//saving to a public area everyone has access from disk functoin
       // Storage::put('post_images',$request->image);//saving/uploding to a non public area of the app
        }     
       //create
      
      $post= Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
       ]); //ignore the red post and its an eloquent syntax
       //use this if has no relationship
       //Post::create(['user_id'=>Auth::id(),...$fields]);
       /* send new post mail */
       Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(),$post));

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
                                                       //this will check if the user is equal to user_id
        Gate::authorize('modify',$post); //modify is the class from postpolicy import gate facades
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
       // be sure to add enctype="multipart/form-data on form that need file handling or more
        // Authorize user can only access the page
        Gate::authorize('modify', $post);
        
        // Validate
        $rules = [
            'title' => 'required|max:15',
            'body' => 'required',
            'image' => 'nullable|file|max:3000|mimes:png,jpg,webp'
        ];
        
        $request->validate($rules);
      
        // Image handling
       $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if($post->image)
            {
                Storage::disk('public')->delete($post->image);
            }
            // Store the new image */
            $path = Storage::disk('public')->put('posts_images',$request->image);
         } 
     
        // Update post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);
    
        // Redirect
        return redirect()->route('dashboard')->with('success', 'Post is updated');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify',$post);
        /* delete image if it exists*/
        if($post->image)
        {
            Storage::disk('public')->delete($post->image);
        }
        /* delete post */
            $post->delete();
        /* redirect to dashboard */
        return back()->with('delete','Post deleted successfully');
    }
}
