<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthService; // Importar el servicio

class AuthenticationController extends Controller
{
    /**
     * La instancia del servicio de autenticación
     * @var AuthService
     */
    public $authService;

    /**
     * Inyectar el servicio en el constructor
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Retorna la lista de usuarios
     * GET /users
     */
    public function index()
    {
        return $this->successResponse($this->authService->obtainUsers());
    }

    /**
     * Crea un usuario (Registro)
     * POST /users
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authService->createUser($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Muestra un usuario específico
     * GET /users/{id}
     */
    public function show($id)
    {
        return $this->successResponse($this->authService->obtainUser($id));
    }

    /**
     * Maneja el inicio de sesión
     * POST /users/login
     */
    public function login(Request $request)
    {
        return $this->successResponse($this->authService->login($request->all()));
    }

    /**
     * Formatea una respuesta JSON exitosa
     *
     * @param mixed $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }
}