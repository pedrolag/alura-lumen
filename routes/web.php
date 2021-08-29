<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Laravel\Lumen\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/** @var Router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api'], function () use ($router) {

    // Séries
    $router->group(['prefix' => '/series'], function () use ($router) {

        // Buscar todas as séries
        $router->get('/', 'SeriesController@index');

        // Buscar uma série por id
        $router->get('/{id}', 'SeriesController@show');

        // Adicionar uma nova série
        $router->post('/', 'SeriesController@store');

        // Editar uma série
        $router->put('/{id}', 'SeriesController@update');

        // Excluir uma série
        $router->delete('/{id}', 'SeriesController@destroy');
        
        // Buscar todos os episódios de uma série
        $router->get('/{serieId}/episodios', 'EpisodiosController@buscaPorSerie');

    });

    // Episódios
    $router->group(['prefix' => '/episodios'], function () use ($router) {

        // Buscar todos os episódios
        $router->get('/', 'EpisodiosController@index');

        // Buscar um episódio por id
        $router->get('/{id}', 'EpisodiosController@show');

        // Adicionar um nova episódio
        $router->post('/', 'EpisodiosController@store');

        // Editar um episódio
        $router->put('/{id}', 'EpisodiosController@update');

        // Excluir um episódio
        $router->delete('/{id}', 'EpisodiosController@destroy');

    });

});