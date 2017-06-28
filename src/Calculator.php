<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once(__DIR__ . '/../config/application.php');

class Calculator
{
    private $rates;
    private $symbols;
    private $from;
    private $to;
    private $value;

    public function __construct()
    {
        $this->loadRates();
        $this->loadSymbols();
    }

    private function loadRates(): void
    {
        $this->rates = json_decode(file_get_contents(RATES_PATH), true);
    }

    private function loadSymbols(): void
    {
        $this->symbols = json_decode(file_get_contents(SYMBOLS_PATH), true);
    }

    public function calculate($from, $to, $value): array
    {
        $this->setParams($from, $to, $value);

        $rate = $this->getRate();

        $original_value = $this->format($this->value);
        $converted_value = $this->format($this->value * $rate);

        $conversion['original_value'] = "{$this->getSymbol($this->from)} $original_value";
        $conversion['converted_value'] = "{$this->getSymbol($this->to)} $converted_value";
        $conversion['rate'] = $this->format($rate);

        return $conversion;
    }

    private function setParams($from, $to, $value)
    {
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
    }

    private function getRate(): float
    {
        if (array_key_exists($this->from, $this->rates)) {
            if (array_key_exists($this->to, $this->rates[$this->from])) {
                return floatval($this->rates[$this->from][$this->to]);
            }
        }

        throw new RateNotFoundException('No rate available for the given currencies.');
    }

    private function getSymbol($currency): string
    {
        if (array_key_exists($currency, $this->symbols)) {
            return $this->symbols[$currency];
        }

        throw new SymbolNotFoundException("No symbol available for currency '{$currency}'.");
    }

    private function format($value): string
    {
        return number_format($value, 2);
    }
}

class RateNotFoundException extends \Exception
{
}

class SymbolNotFoundException extends \Exception
{
}
