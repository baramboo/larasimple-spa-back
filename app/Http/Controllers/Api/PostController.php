<?php

namespace App\Http\Controllers\Api;

use App\Core\Controllers\BaseApiController;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Sanctum\Sanctum;
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
//        $token = $request->bearerToken();
//        $model = Sanctum::$personalAccessTokenModel;
//        $accessToken = $model::findToken($token);
//        dd($accessToken->toArray());

        return $this->successApiResponse([
            $this->repository->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
