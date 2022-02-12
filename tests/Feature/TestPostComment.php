<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TestPostComment extends TestCase
{
    use WithFaker;

    private $baseUrl = 'api/post-comments';

    public function testPostsCommentsIndex()
    {
        $user = User::inRandomOrder()->first();
        $this->actAsUser($user->id);

        $response = $this->getJson($this->baseUrl);
        $content = json_decode($response->getContent());
        $response->assertStatus(200);

        $this->assertIsObject($content);

    }

    /**
     * @return bool|PostComment
     */
    private function createTestPostComment(): PostComment
    {
        $data = PostComment::factory()->definition();

        $result = PostComment::create($data);

        return $result;
    }


    public function testPostCommentShow()
    {
        $postComment = $this->createTestPostComment();

        $this->actAsUser($postComment->author_id);

        $response = $this->getJson("{$this->baseUrl}/{$postComment->id}");
        $content = json_decode($response->getContent());

        $response->assertStatus(200);

        $this->assertIsObject($content);
        $postComment->forceDelete();
    }

    public function testPostCommentStore()
    {
        $data = PostComment::factory()->definition();

        $this->actAsUser($data['author_id']);

        $response = $this->postJson($this->baseUrl, $data);

        $content = json_decode($response->getContent());

        $response->assertStatus(200);

        $this->assertIsObject($content);

        $postCommentId = $response->json('data.id');

        $postComment = PostComment::find($postCommentId);

        $postComment->forceDelete();
    }

    public function testPostCommentUpdateByAuthor()
    {
        $postComment = $this->createTestPostComment();

        $this->actAsUser($postComment->author_id);

        $data = [
            'comment' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];

        $response = $this->putJson("{$this->baseUrl}/{$postComment->id}", $data, $this->csrfTokenHeader());
        $content = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertIsObject($content);

        $postComment->forceDelete();
    }


    public function testPostTryUpdateByNotAuthor()
    {
        $postComment = $this->createTestPostComment();

        if ($postComment->author_id > 2) $user_id = $postComment->author_id - 1; else $user_id = $postComment->author_id + 1;
        $this->actAsUser($user_id);

        $data = [
            'comment' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];

        $response = $this->putJson("{$this->baseUrl}/{$postComment->id}", $data, $this->csrfTokenHeader());
        $content = json_decode($response->getContent());

        $response->assertStatus(403);
        $this->assertIsObject($content);

        $postComment->forceDelete();
    }

}
