# Auth Service (Servicio de Autenticación)
Puerto : 8004
Complejidad: ⭐⭐⭐ (Alta)

Descripción:
Maneja la autenticación y autorización de usuarios. Genera y valida tokens JWT.

Endpoints sugeridos:

POST /auth/login - Iniciar sesión
POST /auth/register - Registrar nuevo usuario
POST /auth/logout - Cerrar sesión
POST /auth/refresh - Refrescar token
GET /auth/me - Obtener usuario autenticado
Relaciones:

Consumido por: Gateway (middleware de autenticación)
Consume: Users Service
Conceptos a aprender:

JWT (JSON Web Tokens)
Middleware de autenticación
Encriptación y seguridad
Refresh tokens