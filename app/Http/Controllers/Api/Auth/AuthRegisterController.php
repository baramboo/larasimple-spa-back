<?php

namespace App\Http\Controllers\Api\Auth;

use App\Core\Controllers\BaseApiController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function config;
use function response;

/**
 * Class AuthRegisterController
 * @package App\Http\Controllers\Api
 *
 */
class AuthRegisterController extends BaseApiController
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:250'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
