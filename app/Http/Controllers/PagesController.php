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
            $id = 50
            $posts = Post::orderBy('likes', 'desc')->limit($id)->get();
        }
        return view('index')->with(compact(['posts']));
    }
}
