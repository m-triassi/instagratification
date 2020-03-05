<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        $followers = $loggedInUser->following()->get()->pluck('id');
        $posts = Post::with(['comments', 'comments.author', 'author'])->whereIn('author_id', $followers)->get();
        if ($posts->isEmpty()) {
            $posts = Post::with(['comments', 'comments.author', 'author'])->limit(50)->orderBy('likes', 'desc')->get();
        }

        return view('index')->with(compact(['posts', 'loggedInUser']));
    }
}
