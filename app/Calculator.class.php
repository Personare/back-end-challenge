<?php

namespace CurrencyConverter;

class Calculator
{
    public function __construct($from, $to, $value)
    {
        $this->from = strtoupper($from);
        $this->to = strtoupper($to);
        $this->value = $this->format($value);

        $this->loadRates();
        $this->loadSymbols();
    }

    private function format($value)
    {
        return number_format(floatval($value), 2);
    }

    private function loadRates()
    {
        $this->rates = json_decode(file_get_contents('../config/rates.json'), true);
    }

    private function loadSymbols()
    {
        $this->symbols = json_decode(file_get_contents('../config/symbols.json'), true);
    }

    public function calculate()
    {
        $rate = $this->getRate();
        $converted_value = $this->format($this->value * $rate);

        $conversion['original_value'] = "{$this->symbols[$this->from]} $this->value";
        $conversion['converted_value'] = "{$this->symbols[$this->to]} $converted_value";

        return $conversion;
    }

    private function getRate()
    {
        if (array_key_exists($this->from, $this->rates)) {
            if (array_key_exists($this->to, $this->rates[$this->from])) {
                return $this->format($this->rates[$this->from][$this->to]);
            }
        }

        throw new RateNotFoundException('No rate available for the given currencies.');
    }
}


class RateNotFoundException extends \Exception
{
}
