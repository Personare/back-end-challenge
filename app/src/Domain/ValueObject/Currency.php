<?php


namespace MoneyConverter\Domain\ValueObject;


class Currency {
	private $code;
	private $symbol;

    /**
     * Constructor: __construct
    **/
	public function __construct($code, $symbol) {
		$this->setCode($code);
		$this->setSymbol($symbol);
	}

	private function setCode($code) {
		if (!preg_match('/^[A-Z]{3}$/', $code)) {
			throw new \InvalidArgumentException('Invalid code');
		}

		$this->code = $code;
	}

	private function setSymbol($symbol) {
		$this->symbol = $symbol;
	}

	public function equals(Currency $currency) {
		return $currency->code() === $this->code();
	}

	public function symbol() {
		return $this->symbol;
	}

	public function code() {
		return $this->code;
	}
}

?>