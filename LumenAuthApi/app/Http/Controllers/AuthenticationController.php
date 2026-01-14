<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthenticationController extends Controller
{
    /**
     * Constructor para aplicar middleware a métodos protegidos
     */
    public function __construct()
    {
        // Protege todos los métodos excepto login y register
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Registrar un nuevo usuario
     * POST /auth/register
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // En Lumen, Hash::make se usa comúnmente, o app('hash')->make()
            $user->password = app('hash')->make($request->input('password'));
            
            $user->save();

            return response()->json([
                'entity' => 'users', 
                'action' => 'create', 
                'result' => 'success'
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration Failed!'], 409);
        }
    }

    /**
     * Iniciar sesión y obtener token
     * POST /auth/login
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Obtener usuario autenticado
     * GET /auth/me
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Cerrar sesión (Invalidar el token)
     * POST /auth/logout
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refrescar el token
     * POST /auth/refresh
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Estructura de respuesta del token
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}