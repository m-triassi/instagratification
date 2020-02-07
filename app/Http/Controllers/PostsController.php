<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function like($postID)
    {
        $post = Post::find($postID);
        $post->likes++;
        $post->save();

        return response(['success'=>true]);
    }
}
