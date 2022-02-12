<?php

namespace App\Core\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponder
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return JsonResponse
     */
    protected function successApiResponse($data = ['description' => 'Success'], string $message = 'Response collection', int $code = 200)
    {
        return response()->json([
            'code' => $code,
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return a not found JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return JsonResponse
     */
    protected function notFoundApiResponse($data = ['description' => 'Not found'], string $message = null, int $code = 404)
    {
        return response()->json([
            'code' => $code,
            'status' => 'Resource not found',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return a warning JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return JsonResponse
     */
    protected function warningApiResponse($data = ['description' => 'Warning'], string $message = null, int $code = 400)
    {
        return response()->json([
            'code' => $code,
            'status' => 'Warning',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return JsonResponse
     */
    protected function errorApiResponse($data = ['description' => 'Error'], string $message = 'Error', int $code = 400)
    {
        return response()->json([
            'code' => $code,
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return access denied JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return JsonResponse
     */
    protected function forbiddenApiResponse($data = ['description' => 'Forbidden'], string $message = 'Access denied', int $code = 403)
    {
        return response()->json([
            'code' => $code,
            'status' => 'Forbidden',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
