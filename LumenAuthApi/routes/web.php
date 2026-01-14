<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/users', function () {
    return response()->json(\App\User::all());
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    // Change 'AuthController' to 'AuthenticationController' in all these lines
    $router->post('register', 'AuthenticationController@register'); //
    $router->post('login', 'AuthenticationController@login');       //
    $router->post('logout', 'AuthenticationController@logout');     //
    $router->post('refresh', 'AuthenticationController@refresh');   //
    $router->get('me', 'AuthenticationController@me');              //
});