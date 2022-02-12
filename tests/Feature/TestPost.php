<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TestPost extends TestCase
{
    use WithFaker;

    private $baseUrl = 'api/posts';

    public function testPostsIndex()
    {
        $user = User::inRandomOrder()->first();
        $this->actAsUser($user->id);

        $response = $this->getJson($this->baseUrl);
        $content = json_decode($response->getContent());
        $response->assertStatus(200);

        $this->assertIsObject($content);

    }

    /**
     * @return bool|Post
     */
    private function createTestPost(): Post
    {
        $user = User::inRandomOrder()->first();

        if (!$user) return false;

        $data = [
            'author_id' => $user->id,
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(3, true)
        ];

        $result = Post::create($data);

        return $result;
    }


    public function testPostShow()
    {
        $post = $this->createTestPost();

        $this->actAsUser($post->author_id);

        $response = $this->getJson("{$this->baseUrl}/{$post->id}");
        $content = json_decode($response->getContent());

        $response->assertStatus(200);

        $this->assertIsObject($content);
        $post->forceDelete();
    }

    public function testPostStore()
    {

        $user = User::inRandomOrder()->first();

        $this->actAsUser($user->id);

        $data = [
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(3, true)
        ];

        $response = $this->postJson($this->baseUrl, $data, $this->csrfTokenHeader());
        $content = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertIsObject($content);

        $postId = $response->json('data.id');

        $post = Post::find($postId);

        $post->forceDelete();
    }

    public function testPostUpdateByAuthor()
    {
        $post = $this->createTestPost();

        $this->actAsUser($post->author_id);

        $data = [
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(3, true)
        ];

        $response = $this->putJson("{$this->baseUrl}/{$post->id}", $data, $this->csrfTokenHeader());
        $content = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertIsObject($content);

        $post->forceDelete();
    }


    public function testPostTryUpdateByNotAuthor()
    {
        $post = $this->createTestPost();

        if ($post->author_id > 2) $user_id = $post->author_id - 1; else $user_id = $post->author_id + 1;
        $this->actAsUser($user_id);

        $data = [
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(3, true)
        ];

        $response = $this->putJson("{$this->baseUrl}/{$post->id}", $data, $this->csrfTokenHeader());
        $content = json_decode($response->getContent());

        $response->assertStatus(403);
        $this->assertIsObject($content);

        $post->forceDelete();
    }

}
