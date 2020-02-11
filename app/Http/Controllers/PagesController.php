<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $followers = $user->following()->get()->pluck('id');
        $posts = Post::whereIn('author_id', $followers)->get();
        if ($posts->isEmpty()) {
            $posts = Post::limit(50)->orderBy('likes', 'desc')->get();
        }
        return view('index')->with(compact(['posts']));
    }
}
