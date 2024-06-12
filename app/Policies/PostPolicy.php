<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function modify(User $user, Post $post) // its beter to start with User first then post
    {
        return $user->id === $post->user_id;
    }
}
