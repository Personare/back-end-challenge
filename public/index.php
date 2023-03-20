<?php

declare(strict_types=1);

use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Infraestructure\Http\Controllers\CurrencyConverterController;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Router::get('/currency-converter', function (Request $req, Response $res) {
    (new CurrencyConverterController)->handle($req, $res);
});
