<?php declare(strict_types = 1);

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use App\Controller\Exchange as Controller;
use App\Service\Exchange;
use App\Util\Responses;

$controller = new Controller(new Exchange, new Responses);
$controller->restApi();
