<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::where('id', $id)
            ->orWhere("name", $id)
            ->with('posts', 'posts.comments', 'followers', 'following')
            ->firstOrFail();

        $loggedInUser = Auth::user();
        $userCanFollow = !($loggedInUser->following()->get()->contains($user->id));

        return view('user.view')->with(compact(['user', 'userCanFollow']));
    }

    public function follow(Request $request)
    {
        $followedID = $request->userID;
        $user = Auth::user();
        $user->following()->attach($followedID);

        return redirect()->back();

    }
    public function unfollow(Request $request)
    {
        $followedID = $request->userID;
        $user = Auth::user();
        $user->following()->detach($followedID);

        return redirect()->back();

    }
}
