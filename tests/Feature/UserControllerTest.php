<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_follow_another_user()
    {
        $follower = factory(User::class)->create();
        $leader = factory(User::class)->create();

        $this->actingAs($follower);

        $response = $this->json('POST', 'user/follow', ['userID' => $leader->id]);
        $leader = $leader->find($leader->id);

        $this->assertEquals($follower->id, $leader->followers[0]->id);
    }

    /** @test */
    public function user_can_unfollow_another_user()
    {
        $follower = factory(User::class)->create();
        $leader = factory(User::class)->create();

        $this->actingAs($follower);
        $response = $this->json('POST', 'user/unfollow', ['userID' => $leader->id]);
        $leader = $leader->find($leader->id);

        $this->assertCount(0, $leader->followers);


    }
}
