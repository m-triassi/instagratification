<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index()
    {
      $posts = Post::limit(3)->orderBy('created_at', "desc")->get();
      return view('index')->with(compact(['posts']));
    }
}
