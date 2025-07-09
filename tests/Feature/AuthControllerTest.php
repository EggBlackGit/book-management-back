<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    public function test_register_success()
    {
        $payload = [
            'name' => 'Test User',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(200)
                 ->assertJsonStructure(['user' => ['id', 'name', 'email'], 'token']);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_register_password_confirmation_mismatch()
    {
        $payload = [
            'name' => 'Test User',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password123',
            'password_confirmation' => 'notmatching',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422);
    }


    public function test_login_success()
    {
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
            'password' => bcrypt('password123'),
        ]);

        $payload = [
            'email' => $email,
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $payload);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    public function test_login_invalid_credentials()
    {
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
            'password' => bcrypt('password123'),
        ]);

        $payload = [
            'email' => $email,
            'password' => bcrypt('wrongpassword'),
        ];

        $response = $this->postJson('/api/login', $payload);

        $response->assertStatus(401)
                 ->assertJson(['error' => 'Invalid credentials']);
    }

    public function test_me_authenticated()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->getJson('/api/me');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $user->id,
                     'email' => $user->email,
                 ]);
    }

    public function test_me_unauthenticated()
    {
        $response = $this->getJson('/api/me');

        $response->assertStatus(401);
    }

    public function test_logout_authenticated()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Successfully logged out']);
    }

    public function test_logout_unauthenticated()
    {
        $response = $this->postJson('/api/logout');

        $response->assertStatus(401);
    }
}
