<?php
require_once __DIR__ . '/bootstrap.php';

use Personare\Exchange\Business\Exchange;
use Personare\Exchange\DataAccess\CurrencyDAO;
use Personare\Exchange\View\ExchangeController;

// Uses fake database to store currencies
$fakePdo = createFakeDatabase();

$currencyDao = new CurrencyDAO($fakePdo);
$exchange = new Exchange($currencyDao);
$controller = new ExchangeController($exchange);
$controller->convert();
