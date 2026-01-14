<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthService
{
    use ConsumesExternalService;

    /**
     * La base URI del servicio externo (Auth Service)
     * @var string
     */
    public $baseUri;

    /**
     * El secreto para validar JWT (opcional si se comparte config)
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.auth.base_uri');
        // Si necesitaras pasar algún secreto extra en headers, lo harías aquí
    }

    /**
     * Obtener lista de usuarios (solo ejemplo)
     */
    public function obtainUsers()
    {
        return $this->performRequest('GET', '/auth/users');
    }

    /**
     * Crear un usuario (Registro)
     */
    public function createUser($data)
    {
        // El Auth Service espera POST /auth/register
        return $this->performRequest('POST', '/auth/register', $data);
    }

    /**
     * Obtener un usuario por ID
     */
    public function obtainUser($id)
    {
        return $this->performRequest('GET', "/auth/users/{$id}");
    }

    /**
     * Realizar Login (Este es clave)
     */
    public function login($data)
    {
        // El Auth Service espera POST /auth/login
        return $this->performRequest('POST', '/auth/login', $data);
    }
}