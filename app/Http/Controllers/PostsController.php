<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class PostsController extends Controller
{
    public function like(Request $request)
    {
        $postID = $request->postID;

        $post = Post::findOrFail($postID);
        $post->likes++;
        $post->save();

        return response(['success' => true]);
    }

    public function show($postID)
    {
        $post = Post::with('comments', 'comments.author', 'author')->findorFail($postID);

        return View('posts.view')->with(compact(['post']));
    }

    public function create(Request $request)
    {
        // TODO: add Request validation
        $post = new Post();
        $post->id = Uuid::uuid4();
        $post->caption = $request->caption;
        $image = base64_decode(substr($request->media, strpos($request->media, ',') + 1));
        Storage::put('posts/'.$post->id, $image);
        $post->media = '/storage/posts/'.$post->id;
        $post->author()->associate(Auth::user());
        $post->save();

        return response(['success' => true]);
    }
}
