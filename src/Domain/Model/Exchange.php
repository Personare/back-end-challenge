<?php

namespace Personare\Exchange\Domain\Model;

class Exchange
{
    private $from;
    private $to;
    private $value;

    public function __construct(Currency $from, Currency $to, float $value)
    {
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;

        $this->validate();
    }

    private function validate()
    {
        if (empty($this->value)) {
            throw new \InvalidArgumentException("'value' is required.");
        }
        if ($this->value < 0) {
            throw new \InvalidArgumentException("'value' must be a number greater than zero.");
        }
    }

    public function convert() : float
    {
        if ($this->to->getBase() == true) {
            return $this->value * $this->from->getValue();
        } else {
            return $this->value / $this->to->getValue();
        }
    }
}