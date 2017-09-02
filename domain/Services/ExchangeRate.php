<?php

namespace Domain\Services;

class ExchangeRate
{
    /**
     * @var float
     */
    private $rate;

    /**
     * @var float
     */
    private $value;

    /**
     * @param mixed $rate
     * @return $this
     */
    public function rate(float $rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function value(float $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return float
     */
    public function convertion(): float
    {
        return $this->rate * $this->value;
    }
}