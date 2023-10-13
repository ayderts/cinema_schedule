<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials) : JsonResponse
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->accessToken;
            return response()->json([
                'status'=>true,
                'token'=>$token
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Неверный логин или пароль'
        ]);
    }
}
