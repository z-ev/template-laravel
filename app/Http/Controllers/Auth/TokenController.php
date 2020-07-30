<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\Token;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserAgent;

class TokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Token $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'credentials' => 'The provided credentials are incorrect.'
                ],
            ], 422);
        }

        if ($user->role_key === null && $user->id != 1) {
            return response()->json([
                'message' => 'User does not have permissions.',
                'errors' => [
                    'permissions' => 'User does not have permissions.'
                ]
            ], 401);
        }

        $token = $user->createToken($request->device_name, $user->permissionRoutes()->toArray());

        $tokenAgent = UserAgent::create([
            'token_id' => $token->accessToken->id,
            'user_id' => $user->id,
            'agent' => $request->header('User-Agent'),
            'ip' => $request->getClientIp(),
        ]);

        return response()->json([
            'message' => 'Token created successfully.',
            'date' => [
                'token' => $token->plainTextToken,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]
        ], 200);
    }
}
