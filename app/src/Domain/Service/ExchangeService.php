<?php


namespace MoneyConverter\Domain\Service;

use MoneyConverter\Domain\ValueObject\Money;
use MoneyConverter\Domain\ValueObject\Currency;
use MoneyConverter\Domain\Entity\Exchange;
use MoneyConverter\Domain\Repository\ExchangeRepositoryInterface;

class ExchangeService {
	private $exchangeRepository;

	public function __construct(ExchangeRepositoryInterface $exchangeRepository) {
		$this->exchangeRepository = $exchangeRepository;
	}

	public function convert(Currency $fromCurrency, Currency $toCurrency, $amount) {
		$quoteMoney = $this->exchangeRepository->getQuote($fromCurrency, $toCurrency);

		$toMoney = new Money($amount, $toCurrency);
		$exchange = new Exchange($quoteMoney, $toMoney);
		
		return $exchange->convert();
	}
}


?>