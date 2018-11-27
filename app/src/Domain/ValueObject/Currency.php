<?php


namespace MoneyConverter\Domain\ValueObject;


class Currency {
	private $code;

    /**
     * Constructor: __construct
    **/
	public function __construct($code) {
		$this->setCode($code);
	}

	private function setCode($code) {
		if (!preg_match('/^[A-Z]{3}$/', $code)) {
			throw new \InvalidArgumentException('Invalid code');
		}

		$this->code = $code;
	}

	public function equals(Currency $currency) {
		return $currency->code() === $this->code();
	}

	public function symbol() {
		if ($this->code() == 'USD'){
			$symbol = '$';
		} else if ($this->code() == 'EUR'){
			$symbol = '€';
		} else {
			$symbol = 'R$';
		}

		return $symbol;
	}

	public function code() {
		return $this->code;
	}
}

?>