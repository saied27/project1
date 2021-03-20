<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hello-lumen', function(){
    return "<h1>Lumen</h1><p>Hi good developer, Thank for using Lumen</p>";
});

$router->get('/hello-lumen/{name}', function ($name){
    return "<h1>Lumen</h1><p>Hi <b>" . $name . "</b>, Thanks for using Lumen</p>";
});

$router->get('/scores', ['middleware' => 'login', function () {
    return "<h1>Selamat</h1><p>Nilai anda 100</p>";
}]);


Route::group(['middleware'=> ['auth']], function ($router){  
$router->get('/banks', 'BanksController@index');
$router->post('/banks', 'BanksController@store');
$router->get('/bank/{id}', 'BanksController@show');
$router->put('/bank/{id}', 'BanksController@update');
$router->delete('/bank/{id}', 'BanksController@destroy');
});
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

