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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'currency', 'middleware' => '\App\Http\Middleware\CurrencyMiddleware'], function () use ($router) {

    $router->get('/{amount}/{currencyFrom}/{currencyTo}[/{rate}]', 'CurrencyController@convert');

});