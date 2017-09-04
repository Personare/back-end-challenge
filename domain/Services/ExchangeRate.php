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
    private $amount;

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
     * @param float $amount
     * @return $this
     */
    public function amount(float $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return float
     */
    public function convertion(): float
    {
        return $this->rate * $this->amount;
    }
}