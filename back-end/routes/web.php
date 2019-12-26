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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/',['uses' =>  'Controller@index', 'middleware' => 'cors']);
$router->put('/', ['uses' => 'Controller@update', 'middleware' => 'cors']);

// $router->group(['prefix' => 'main'], function () use ($router) {
//     $router->get('/', 'Controller@index');
 
// });
