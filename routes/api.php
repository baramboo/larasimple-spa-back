<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\AuthTokenController;
use Illuminate\Http\Request;
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

Route::post('/login', [ApiAuthController::class, 'login']);
//Route::post('/sanctum/token', AuthTokenController::class);
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
$postController = PostController::class;
Route::prefix('posts')->middleware('auth:api')->group(function () use ($postController) {
    Route::get('/', [$postController, 'index'])->name('posts.index');
});
