<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile(Request $request)
    {
        $user = $request->user(); // Получаем текущего аутентифицированного пользователя

        return response()->json([
            'user' => $user // Отправляем данные пользователя в формате JSON
        ]);
    }

    public function users(Request $request)
    {
        $users = $this->userService->getAllUsers();

        return response()->json($users);
    }
}
