<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index()
    {
      // TODO: make this paginated on all posts relevant to a given user? 
      $posts = Post::limit(50)->orderBy('created_at', "desc")->get();
      return view('index')->with(compact(['posts']));
    }
}
