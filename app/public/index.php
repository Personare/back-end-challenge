<?php


require '../vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use MoneyConverter\Domain\Service\ExchangeAPIService;
use MoneyConverter\Domain\Repository\FixedExchangeRepository;


$ratioList = array(
	'USD' => array(
		'BRL' => 3.900,
		'EUR' => 0.892,
	),
	'EUR' => array(
		'BRL' => 4.460,
		'USD' => 1.120,
	),
	'BRL' => array(
		'USD' => 0.256,
		'EUR' => 0.178,
	),
);

$exchangeRepository = new FixedExchangeRepository($ratioList);
$api = new ExchangeAPIService($exchangeRepository);
$api->run();

?>