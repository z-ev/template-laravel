<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\Register;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserAgent;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Register $request)
    {
        $input = $request->all();
        $roles = config('roles');
        $input['role_key'] = array_key_last($roles);
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $token = $user->createToken($request->device_name, $user->permissionRoutes()->toArray());

        $tokenAgent = UserAgent::create([
            'token_id' => $token->accessToken->id,
            'user_id' => $user->id,
            'agent' => $request->header('User-Agent'),
            'ip' => $request->getClientIp(),
        ]);

        return response()->json([
            'message' => 'Registration completed successfully.',
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
