<?php


namespace MoneyConverter\Domain\ValueObject;


class Money {
	private $amount;
	private $currency;

    /**
     * Constructor: __construct
    **/
	public function __construct($amount, Currency $currency ){
		$this->setAmount($amount);
		$this->setCurrency($currency);

	}

	private function assertNotEmpty($amount){
		if (empty($amount)) {
			throw new \InvalidArgumentException('Amount cant be null');
		}
	}

	private function assertNotNegative($amount) {
		if ($amount < 0) {
			throw new \InvalidArgumentException('Amount must be greater than zero');
		}
	}

	private function setAmount($amount) {
		$this->assertNotEmpty($amount);
		$this->assertNotNegative($amount);

		$this->amount = $amount;
	}

	private function setCurrency(Currency $currency) {
		$this->currency = $currency;
	}

	public function amount() {
		return number_format($this->amount, 3);
	}

	public function currency() {
		return $this->currency;
	}
}

?>