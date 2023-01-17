<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Parte;


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/version', function () use ($router) {
        return $router->app->version();
    });
    $router->get('/partes', function () {
        return Parte::all()->toArray();
    });

    $router->get('/buscar/{termo}', ['uses' => 'MusicaController@buscar']);
    $router->get('/baixar/{id}', ['uses' => 'MusicaController@baixar']);

    $router->get('/playlist', ['uses' => 'PlaylistController@listar']);
    $router->get('/playlist/{id}', ['uses' => 'PlaylistController@musicas']);
    $router->post('/playlist/nova', ['uses' => 'PlaylistController@nova']);
    $router->post('/playlist/add-musica', ['uses' => 'PlaylistController@addMusica']);
    $router->post('/playlist/remover-musica', ['uses' => 'PlaylistController@removerMusica']);
    $router->post('/playlist/remover', ['uses' => 'PlaylistController@remover']);

    $router->get('/cifra/{id}', ['uses' => 'CifraController@visualizar']);

    $router->get('/musicas', ['uses' => 'MusicaController@listar']);
    $router->get('/musicas/{id}', ['uses' => 'MusicaController@visualizar']);
    $router->post('/musicas/remover-secao', ['uses' => 'MusicaController@removerSecao']);
    $router->post('/musicas/nova-secao', ['uses' => 'MusicaController@novaSecao']);
    $router->post('/musicas/atualizar-secao', ['uses' => 'MusicaController@atualizarSecao']);
    $router->post('/musicas/atualizar-ordem', ['uses' => 'MusicaController@atualizarOrdem']);
    $router->post('/musicas/nova', ['uses' => 'MusicaController@nova']);


});
