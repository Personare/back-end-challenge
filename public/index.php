<?php
require '../vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use PersonareExchange\Interfaces\Http\ExchangeController;
use PersonareExchange\Interfaces\Util\Responses;
use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;
use PersonareExchange\Domain\Services\ExchangeService;

$currencyRepository = new CurrencyRepository();
$response = new Responses();
$exchangeService = new ExchangeService($currencyRepository);
$exchangeController = new ExchangeController($exchangeService, $response);
$exchangeController->convert();