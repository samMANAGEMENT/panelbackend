<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;
    
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ]);
            }
    
            return response()->json(['message' => 'usuario no encontrado'], 401);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error en login', 'error' => $th->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Cerrar sesión del usuario
            Auth::logout();

            // Invalidar la sesión actual
            $request->session()->invalidate();

            // Regenerar el token CSRF
            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Sesión cerrada exitosamente'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al intentar cerrar la sesión',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
