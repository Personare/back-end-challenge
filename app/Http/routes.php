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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api/v1','namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function ($app) {

    $app->get('from/{currency_from}/to/{currency_to}/value/{value}', 'CurrencyController@getCurrencyConvertedValue');

});
