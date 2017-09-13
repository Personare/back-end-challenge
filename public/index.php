<?php

require __DIR__ . '/../vendor/autoload.php';

$router = new \App\Router();

$router->collection()->map('GET', '/{from}/{to}/{amount}', 'App\Controllers\ExchangeController::process');
$router->collection()->map('GET', '/{from}/{to}/{amount}/{rate}', 'App\Controllers\ExchangeController::process');

$router->dispatch();