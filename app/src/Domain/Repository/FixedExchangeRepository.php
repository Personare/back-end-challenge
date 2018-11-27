<?php


namespace MoneyConverter\Domain\Repository;

use MoneyConverter\Domain\ValueObject\Currency;
use MoneyConverter\Domain\ValueObject\Money;
use MoneyConverter\Domain\Repository\ExchangeRepositoryInterface;


class FixedExchangeRepository implements ExchangeRepositoryInterface{
	private $list;

	public function __construct(array $list) {
		$this->list = $list;
	}

	public function getQuote(Currency $fromCurrency, Currency $toCurrrency) {
		$quote = $this->list[$fromCurrency->code()][$toCurrrency->code()];
		if (isset($quote)) {
			return new Money($quote, $fromCurrency);
		}
	}
}

?>