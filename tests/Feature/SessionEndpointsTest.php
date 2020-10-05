<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SessionEndpointsTest extends TestCase
{
    use DatabaseMigrations;

    public function testSignUp()
    {
        $response = $this->postJson('/api/signup', [
            'email' => 'test@test.com',
            'name' => 'Test Name',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'pd_agreement' => true
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['auth_token', 'token_type', 'expires_in']);
    }

    public function testSignIn()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/signin', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['auth_token', 'token_type', 'expires_in']);
    }
}
