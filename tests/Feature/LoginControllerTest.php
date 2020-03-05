<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
  use RefreshDatabase;

    /** @test */
    public function logged_in_Users_can_not_access_login_view(){

        $user = factory(User::class)->create();

        $response = $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertRedirect('');

    }
    /** @test */
    public function non_logged_in_users_can_access_login_view(){

        $response = $this->get('/login');

        $response->assertOk();

        $response->assertViewIs('auth.login');

    }


}
