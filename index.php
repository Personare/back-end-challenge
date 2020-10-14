<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use App\Controller\ApiController;
use App\Service\CurrencyService;
use App\Http\Response\JsonResponse;

$controller = new ApiController(new CurrencyService, new JsonResponse);
$controller->personareApi();
