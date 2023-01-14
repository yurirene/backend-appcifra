<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Parte;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/partes', function () {
    return Parte::all()->toArray();
});

$router->get('/buscar/{termo}', ['uses' => 'MusicaController@buscar']);
$router->get('/baixar/{id}', ['uses' => 'MusicaController@baixar']);
