<?php

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

$router->group(['prefix' => 'posts'], function () use ($router) {
    //get all posts
    $router->get('/', ['uses' => 'posts@index']);
    //get specific car
    $router->get('/{id:[0-9]+}', ['uses' => 'posts@show']);
    //store new car
    $router->post('', ['uses' => 'posts@store']);
    //edit specific car
    $router->put('/{id:[0-9]+}', ['uses' => 'posts@update']);
    //delete car
    $router->delete('/{id:[0-9]+}', ['uses' => 'posts@delete']);
});



