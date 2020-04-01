<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_post_a_post()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post = factory(Post::class)->make();

        $response = $this->json(
            'POST',
            '/post/create',
            [
                'caption' => $post->caption,
                'media' => base64_encode(file_get_contents($post->media)),
            ]
        );
        $savedPost = Post::where('author_id', $user->id)->first();
        $this->assertNotNull($savedPost);
        $this->assertEquals($user->id, $savedPost->author_id);
        $this->assertFileExists(storage_path('app/public/posts/'.$savedPost->id));

        // Clean up media
        Storage::delete('posts/'.$savedPost->id);
    }

    /** @test */
    public function user_can_like_a_post()
    {
        $poster = factory(User::class)->create();
        $liker = factory(User::class)->create();
        $this->actingAs($liker);
        $post = factory(Post::class)->make();
        $post->author()->associate($poster)->save();

        $originalLikes = $post->likes;
        $response = $this->json('POST', '/post/like', ['postID' => $post->id]);
        $post = $post->find($post->id);

        $this->assertEquals($post->likes, $originalLikes + 1);
    }

    /** @test */
    public function user_can_comment_on_an_exisiting_post()
    {
        $poster = factory(User::class)->create();
        $commenter = factory(User::class)->create();
        $comment = factory(Comment::class)->make();
        $this->actingAs($commenter);
        $post = factory(Post::class)->make();
        $post->author()->associate($poster)->save();

        $this->json(
            'POST',
            'comment/create',
            [
                'comment' => $comment->comment,
                'author' => $commenter->id,
                'postID' => $post->id,
            ]
        );

        $response = $this->get('comments/'.$post->id);
        $comments = json_decode($response->getContent());
        $this->assertCount(1, $comments);
        $this->assertEquals($commenter->id, $comments[0]->author_id);
    }
}
