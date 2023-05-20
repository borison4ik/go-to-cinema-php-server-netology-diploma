<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request) : Response
    {

        $user = Auth::user();

        if (!$user) {
            return response([
                'message'=>'Пользователь не авторизован'
            ], 401);
        }

        return response([
            'message'=>'Пользователь уже авторизован'
        ], 200);

    }

    public function register(Request $request) : Response
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);


        $isAdmin = User::where(['role' => 1])->first();


        if ($isAdmin) {
            return response([
                'message' => 'Администратор уже существует',
            ], 403);
        }

        $user = new User([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $user->save();

        $token = $user->createToken($fields['email'])->plainTextToken;

        $response = [
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ],
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) : Response
    {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user['password'])) {
            return response([
                'message' => 'Ошибка авторизайии, проверьте вводимые данные'
            ], 401);
        }

        $token = $user->createToken($fields['email'])->plainTextToken;

        $response = [
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ],
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request) : Response
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logget out',
        ]);
    }
}