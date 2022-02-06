<?php

namespace App\Http\Controllers\Api\Auth;

use App\Core\Controllers\BaseApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function config;
use function response;

/**
 * Class AuthLoginController
 * @package App\Http\Controllers\Api
 *
 */
class AuthLoginController extends BaseApiController
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
            'remember_me' => ['integer','in:1,2']
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->errorApiResponse('Invalid credentials', 422);
        }

        $token = $this->createAccessToken($request);

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
//            'csrf' => request()->session()->token()
        ], 200);
    }


    /**
     * Generate access token for user auth
     * @param Request $request
     * @return \Laravel\Passport\PersonalAccessTokenResult
     */
    private function createAccessToken(Request $request)
    {
        try {
            $token = Auth::user()->createToken(config('app.name'));
        } catch (\Exception $exception) {
            dd(
                [
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                    'line' => $exception->getLine(),
//                    'trace' => $exception->getTrace(),
                ]
            );
        }

        $rememberMe = $request->get('remember_me');

        $token->token->expires_at = ($rememberMe && $rememberMe == 1) ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $token->token->save();

        return $token;
    }

}
