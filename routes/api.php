<?php

use App\Http\Controllers\Api\Auth\AuthLoginController;
use App\Http\Controllers\Api\Auth\AuthRegisterController;
use App\Http\Controllers\Api\PostCommentController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthLoginController::class, 'login']);
Route::post('/register', [AuthRegisterController::class, 'register']);

//Route::post('/sanctum/token', AuthTokenController::class);
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//

$postController = PostController::class;
Route::prefix('posts')
    ->middleware('auth:api')
    ->group(function () use ($postController) {
    Route::get('/', [$postController, 'index'])->name('posts.index');
    Route::post('/', [$postController, 'store'])->name('post.store');
    Route::get('/{post}', [$postController, 'show'])->name('post.show');
    Route::put('/{post}', [$postController, 'update'])->name('post.update');
    Route::delete('/{post}', [$postController, 'delete'])->name('post.delete');
});

$postCommentController = PostCommentController::class;
Route::prefix('post-comments')
    ->middleware('auth:api')
    ->group(function () use ($postCommentController) {
    Route::get('/', [$postCommentController, 'index'])->name('post-comments.index');
    Route::post('/', [$postCommentController, 'store'])->name('post-comment.store');
    Route::get('/{postComment}', [$postCommentController, 'show'])->name('post-comment.show');
    Route::put('/{postComment}', [$postCommentController, 'update'])->name('post-comment.update');
    Route::delete('/{postComment}', [$postCommentController, 'delete'])->name('post-comment.delete');
});
