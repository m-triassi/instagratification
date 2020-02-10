<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function like(Request $request)
    {
        $postID = $request->postID;

        $post = Post::findOrFail($postID);
        $post->likes++;
        $post->save();

        return response(['success'=>true]);
    }
    public function show($postID){
        $post = Post::findorFail($postID);

        return View("posts.view")->with(compact(["post"]));
    }
}
