<?php


require '../vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use MoneyConverter\Domain\Service\ExchangeAPIService;
use MoneyConverter\Domain\Repository\FixedExchangeRepository;
use MoneyConverter\Domain\Repository\CryptoCompareExchangeRepository;


switch ($_GET['repository']) {
	case 'cryptocompare':
		$exchangeRepository = new CryptoCompareExchangeRepository($ratioList);
		break;
	default:
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
		break;
}

$api = new ExchangeAPIService($exchangeRepository);
$api->run();

?>