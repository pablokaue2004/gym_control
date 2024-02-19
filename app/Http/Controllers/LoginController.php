<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['authToken' => $token, 'message' => 'Login bem-sucedido']);
        } else {
            // Autenticação falhou
             return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    }

    public function logout(Request $request)
    {

        if ($request->user()) {
            $request->user()->token()->revoke();
        }

        return response()->json([
           'message' => 'Successfully logged out'
        ]);
    }
}
