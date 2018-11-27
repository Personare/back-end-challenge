<?php


namespace MoneyConverter\Domain\Repository;

use MoneyConverter\Domain\ValueObject\Currency;


interface ExchangeRepositoryInterface {
	public function getQuote(Currency $fromCurrency, Currency $toCurrency);
}

?>