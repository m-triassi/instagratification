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
        $comments = Comment::where('post_id', $postID)->orderBy('created_at', 'asc')->with('author')->get();

        return $comments;
    }
    public function destroy(Request $request)
    {
      $commentID = $request->commentID;
      $comment = Comment::with('author')->findOrFail($commentID);
      if (auth()->user()->is($comment->author))
      {
        $comment->delete();
      }

      return back();
    }

    public function edit(Request $request)
    {
        $commentID = $request->comment_id;
        $newComment = $request->comment;
        $comment = Comment::find($commentID);

        if(Auth::user()->id == $comment->author_id)
        {
            $comment->comment = $newComment;
            $result = $comment->save();

            return response(['success' => $result]);
        }
        else
            return response(['success' => false]);
    }
}
