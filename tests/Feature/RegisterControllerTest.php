<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
  use RefreshDatabase;

    public function test_Logged_In_User_Can_Not_Access_Register_View(){

        $user = factory(User::class)->create();

        $response = $this->actingAs($user);

        $response = $this->get('/register');

        $response->assertRedirect('');

    }

    public function test_Non_logged_In_User_Can_Access_Register_View(){

        $response = $this->get('/register');

        $response->assertOk();

        $response->assertViewIs('auth.register');

    }

}
