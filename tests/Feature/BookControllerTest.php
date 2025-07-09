<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookControllerTest extends TestCase
{
    protected function authenticate()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        return ['Authorization' => "Bearer $token"];
    }

    public function test_can_list_books()
    {
        Book::factory()->count(3)->create();

        $response = $this->getJson('/api/books', $this->authenticate());

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'current_page', 'last_page', 'total']);
    }

    public function test_can_create_book()
    {
        $payload = [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'published_year' => 2020,
            'genre' => 'Test Genre'
        ];

        $response = $this->postJson('/api/books', $payload, $this->authenticate());

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Test Book']);
    }

    public function test_can_update_book()
    {
        $book = Book::factory()->create([
            'title' => 'Old Title',
            'author' => 'Old Author'
        ]);

        $payload = [
            'title' => 'New Title',
            'author' => 'New Author'
        ];

        $response = $this->putJson("/api/books/{$book->id}", $payload, $this->authenticate());

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'New Title']);
    }

    public function test_can_delete_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}", [], $this->authenticate());

        $response->assertStatus(200);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
