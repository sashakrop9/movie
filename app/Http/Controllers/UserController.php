<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user(); // Получаем текущего аутентифицированного пользователя

        return response()->json([
            'user' => $user // Отправляем данные пользователя в формате JSON
        ]);
    }
}
