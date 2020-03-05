<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;


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
    public function destroy(comment $comment)
    {

      if (auth()->user()->is($comment->user))
      {
        $comment->delete();
      }

      return back();

    }
}
