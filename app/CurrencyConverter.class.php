<?php

namespace Currency;

class Converter
{
    public function __construct($from, $to, $value)
    {
        $this->from = strtoupper($from);
        $this->to = strtoupper($to);
        $this->value = $this->currencyFormatter($value);

        $this->loadRates();
        $this->loadSymbols();
    }

    private function currencyFormatter($value)
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

    public function convert()
    {
        $rate = $this->getRate();
        $converted_value = $this->currencyFormatter($this->value * $rate);

        $convertion['original_value'] = "{$this->symbols[$this->from]} $this->value";
        $convertion['converted_value'] = "{$this->symbols[$this->to]} $converted_value";

        return json_encode($convertion);
    }

    private function getRate()
    {
        if (array_key_exists($this->from, $this->rates)) {
            if (array_key_exists($this->to, $this->rates[$this->from])) {
                return $this->currencyFormatter($this->rates[$this->from][$this->to]);
            } else {
                throw new \Exception('Rate not available.');
            }
        } else {
            throw new \Exception('Rate not available.');
        }
    }
}
