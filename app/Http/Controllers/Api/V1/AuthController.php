<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Для валидации
use Illuminate\Validation\Rules\Password; // Для более строгих правил пароля

class AuthController extends Controller
{
    /**
     * Регистрация нового пользователя.
     * POST /api/v1/auth/register
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name ?? $request->username, // Если name не пришел, используем username
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Пользователь успешно зарегистрирован!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201); // 201 Created
    }

    /**
     * Вход пользователя.
     * POST /api/v1/auth/login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    => 'required|string', // Это будет либо email, либо username
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$loginField => $request->input('login'), 'password' => $request->input('password')];

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Неверные учетные данные'], 401); // 401 Unauthorized
        }

        $user = User::where($loginField, $request->input('login'))->firstOrFail();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Вход выполнен успешно!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    /**
     * Выход пользователя (удаление текущего токена).
     * POST /api/v1/auth/logout (должен быть защищен)
     */
    public function logout(Request $request)
    {
        // Убедимся, что пользователь аутентифицирован, прежде чем пытаться удалить токен
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Вы успешно вышли из системы']);
        }
        return response()->json(['message' => 'Пользователь не аутентифицирован'], 401);
    }

    /**
     * Получение информации о текущем аутентифицированном пользователе.
     * GET /api/v1/auth/user (должен быть защищен)
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
