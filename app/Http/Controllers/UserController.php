<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::where('id', $id)
            ->orWhere("name", $id)
            ->with('posts', 'posts.comments', 'followers', 'following')
            ->firstOrFail();

        return view('user.view')->with(compact(['user']));
    }
}
