<?php


namespace MoneyConverter\Domain\Repository;

use MoneyConverter\Domain\ValueObject\Currency;
use MoneyConverter\Domain\ValueObject\Money;
use MoneyConverter\Domain\Repository\ExchangeRepositoryInterface;

/**
 *
 * Cryptocompare Exchange
 *
 * Provides a way to get exchange ratio from
 * cryptocompare.com.
 * 
 * TODO:
 * - criar wrapper para crytocompare api;
 * - melhorar a implementação desse tipo de classe;
 *
 */
class CryptoCompareExchangeRepository implements ExchangeRepositoryInterface {
	private $publicEndpoint = "https://min-api.cryptocompare.com";
	private $action = "/data/price";

	public function getQuote(Currency $fromCurrency, Currency $toCurrency) {
		$args = array(
			"fsym" => $fromCurrency->code(),
			"tsyms" => $toCurrency->code(),
		);
		$params = http_build_query($args);

		$url = $this->publicEndpoint . $this->action . "?" . $params;
		$contents = file_get_contents($url);

		$data = json_decode($contents, true);

		return new Money($data[$toCurrency->code()], $toCurrency);
	}
}