<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Tests\TestCase;


class ArticleTest extends TestCase
{
    /**
     * @test
     */
    public function articles_are_created_correctly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Lorem1',
            'body' => 'Ipsum1',
        ];

        $this->json('POST', 'api/articles', $payload, $headers)
            ->assertStatus(201)
            ->assertJson(['id' => 1, 'title' => 'Lorem1', 'body' => 'Ipsum1']);
    }

    /**
     * @test
     */
    public function articles_are_updated_correctly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $payload = [
            'title' => 'Updated First Article',
            'body' => 'Updated Body',
        ];

        $response = $this->json('PUT', 'api/articles/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => $article->id,
                'title' => 'Updated First Article',
                'body' => 'Updated Body'
            ]);
    }

    /**
     * @test
     */
    public function articles_are_deleted_correctly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $this->json('DELETE', 'api/articles/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    /**
     * @test
     */
    public function articles_are_listed_correctly()
    {
        factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body'
        ]);

        factory(Article::class)->create([
            'title' => 'Second Article',
            'body' => 'Second Body'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', 'api/articles', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'title' => 'First Article', 'body' => 'First Body' ],
                [ 'title' => 'Second Article', 'body' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
            ]);
    }
}
