<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
       
     //  $post = Post::where('user_id',Auth::id())->get(); oldway retive data with no relationships
     $posts = Auth::user()->posts()->latest()->paginate(6); //posts() is different its a property from posts   //$posts = Auth::user()->posts this will change if chained to post()
     return view('users.dashboard',['posts'=> $posts ]);
    }

    public function userPosts(User $user){
 
        $fields= $user->posts()->latest()->paginate(6);
        return view('users.posts',[
            'posts'=>$fields,
            'user'=>$user
        ]);

    }
}
  