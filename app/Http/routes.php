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


$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1'], function ($app) {
    $app->get('from/{currency_from}/to/{currency_to}/value/{value}', 'CurrencyController@getCurrencyConvertedValue');
});
