<?php

namespace App\Http\Controllers\Api;

use App\Core\Controllers\BaseApiController;
use App\Http\Requests\PostComment\StorePostCommentRequest;
use App\Http\Requests\PostComment\UpdatePostCommentRequest;
use App\Models\Post;
use App\Models\PostComment;
use App\Repositories\PostCommentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function app;

/**
 * Class PostCommentController
 * @package App\Http\Controllers\Api
 *
 * @property PostCommentRepository $repository
 */
class PostCommentController extends BaseApiController
{

    public function __construct()
    {
        parent::__construct();
        $this->repository = app(PostCommentRepository::class);
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
     * @param StorePostCommentRequest $request
     * @return JsonResponse
     */
    public function store(StorePostCommentRequest $request)
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
            'New comment created successfully',
        );

    }

    /**
     * Display the specified resource.
     *
     * @param PostComment $postComment
     * @return JsonResponse
     */
    public function show(PostComment $postComment)
    {
        return $this->successApiResponse(
            $postComment->load('post')
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostCommentRequest $request
     * @param PostComment $postComment
     * @return JsonResponse
     */
    public function update(UpdatePostCommentRequest $request, PostComment $postComment)
    {
        if ($postComment->author_id != $request->user()->id) {
            return $this->warningApiResponse(
                [],
                'Only author can update this comment',
                '403'
            );
        }

        $this->repository->update($postComment, $request->validated());

        return $this->successApiResponse(
            $postComment,
            'Comment updated successfully',
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostComment $postComment
     * @return JsonResponse
     */
    public function delete(PostComment $postComment)
    {
        if ($postComment->author_id != auth()->user()->id) {
            return $this->forbiddenApiResponse(
                [
                    'description' => 'Only Post Author Can perform this operation.'
                ]
            );
        }

        if ($this->repository->delete($postComment)) {
            return $this->successApiResponse(
                [],
                'Comment deleted successfully',
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
