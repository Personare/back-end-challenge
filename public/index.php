<?php

require_once('..' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use Personare\Exchange\Web\Controller\ExchangeController;
use Personare\Exchange\Application\Service\ExchangeService;
use Personare\Exchange\Infrastructure\Repository\CurrencyRepository;

$db = createDatabase();

$currencyRepository = new CurrencyRepository($db);
$exchangeService = new ExchangeService($currencyRepository);

$exchangeController = new ExchangeController($exchangeService);
$exchangeController->index();