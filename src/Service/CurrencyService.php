<?php

namespace App\Service;

use App\Domain\Currency\Interfaces\CurrencyInterface;
use App\Utils\CurrencyUtil;
use App\Config\CurrencyConfig;

use InvalidArgumentException;

class CurrencyService
{
    protected CurrencyInterface $from;
    protected CurrencyInterface $to;

    protected $availableConversions = CurrencyConfig::AVAILABLE_CONVERSIONS;

    public function setFrom(CurrencyInterface $from): self
    {
        $this->from = $from;
        return $this;
    }

    public function setTo(CurrencyInterface $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function getConversion(float $value, float $rate): array
    {
        if (!CurrencyUtil::canConvert($this->availableConversions, $this->from, $this->to)) {
            throw new InvalidArgumentException('Conversion unavailable.');
        }

        return [
            'convertedValue' => $this->convert($value, $rate),
            'currencySymbol' => $this->to->getSymbol()
        ];
    }

    private function convert(float $value, float $rate): float
    {
        if ($value <= 0 || $rate <= 0) {
            throw new \InvalidArgumentException('Value and rate must be greather then 0.');
        }

        return number_format($value / $rate, 2);
    }

}
