<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function logged_in_users_can_access_index_view()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user);

        $response = $this->get('');

        $response->assertOk();

        $response->assertViewIs('index');
    }

    /** @test */
    public function Non_logged_in_users_can__not_access_index_view()
    {
        $response = $this->get('');

        $response->assertRedirect('/login');
    }
}
