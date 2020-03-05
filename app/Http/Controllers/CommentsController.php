<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function create(Request $request)
    {
        $content = $request->comment;
        $author = $request->author;
        $post = $request->postID;

        $comment = new Comment();
        $comment->comment = $content;
        $comment->post()->associate($post);
        $comment->author()->associate($author);

        $result = $comment->save();

        return response(['success' => $result]);


    }
    public function refresh($postID)
    {
        $comments = Comment::where("post_id", $postID)->with('author')->get();
        return $comments;
    }

    public function edit(Request $request,$commentID)
    {
        $newComment = $request->input("comment");
        $comment = Comment::where("id", $commentID)->first();
        $comment->comment = $newComment;

        if(Auth::user()->id == $comment->author_id)
        {
            $result = $comment->save();

            return response(['success' => $result]);
        }
        else
            return response(['success' => false]);
    }
}
