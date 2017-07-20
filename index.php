<?php

require 'vendor/autoload.php';
require_once('src/CurrencyConverter.php');
use Slim\App as App;

$app = new App();

$app->get('/', function ($request, $response, $args) {
    $cc = new CurrencyConverter(
        $_GET['currency_from'],
         $_GET['currency_to'],
         $_GET['exchange'],
         $_GET['value']
    );
    return $response->withJson($cc->build(), $cc->status());
});

$app->run();
