<?php

namespace App\Http\Controllers\Api;

use App\Core\Controllers\BaseApiController;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function app;

/**
 * Class PostController
 * @package App\Http\Controllers\Api
 *
 * @property PostRepository $repository
 */
class PostController extends BaseApiController
{

    public function __construct()
    {
        parent::__construct();
        $this->repository = app(PostRepository::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->successApiResponse([
            $this->repository->getAll()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        $newPost = $this->repository->create(
            array_merge(
                [
                    'author_id' => $request->user()->id,
                ],
                $request->validated()
            )
        );

        return $this->successApiResponse(
            $newPost,
            'New post created successfully',
        );

    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post)
    {
        return $this->successApiResponse(
            $post->load('comments')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->author_id != $request->user()->id) {
            return $this->warningApiResponse(
                [],
                'Only author can update this post',
                '403'
            );
        }

        $this->repository->update($post, $request->validated());

        return $this->successApiResponse(
            $post,
            'Post updated successfully',
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function delete(Post $post)
    {
        if ($post->author_id != auth()->user()->id) {
            return $this->forbiddenApiResponse(
                [
                    'description' => 'Only Post Author Can perform this operation.'
                ]
            );
        }

        if ($this->repository->delete($post)) {
            return $this->successApiResponse(
                [],
                'Post deleted successfully',
            );
        } else {
            return $this->errorApiResponse(
                [],
                'Unknown error',
                400,
            );
        }
    }
}
