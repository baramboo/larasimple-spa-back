<?php

use App\Http\Controllers\Api\Auth\AuthLoginController;
use App\Http\Controllers\Api\Auth\AuthRegisterController;
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
Route::prefix('posts')->middleware('auth:api')->group(function () use ($postController) {
    Route::get('/', [$postController, 'index'])->name('posts.index');
    Route::get('/{post}', [$postController, 'show'])->name('post.show');
    Route::post('/', [$postController, 'store'])->name('post.store');
    Route::put('/{post}', [$postController, 'update'])->name('post.update');
    Route::delete('/{post}', [$postController, 'delete'])->name('post.delete');
});
