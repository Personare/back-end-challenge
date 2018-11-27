<?php


namespace MoneyConverter\Domain\Entity;

use MoneyConverter\Domain\ValueObject\Money;
use MoneyConverter\Domain\ValueObject\Currency;


class Exchange {
	private $toMoney;
	private $quoteMoney;

	public function __construct(Money $quoteMoney, Money $toMoney) {
		$this->setQuoteMoney($quoteMoney);
		$this->setToMoney($toMoney);
	}

	private function setQuoteMoney($aMoney) {
		$this->quoteMoney = $aMoney;
	}

	private function setToMoney($aMoney) {		
		$this->toMoney = $aMoney;
	}

	public function convert() {
		$convertedAmount = $this->quoteMoney->amount() * $this->toMoney->amount();
		return new Money($convertedAmount, $this->toMoney->currency());
	}
}

?>