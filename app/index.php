<?php

require '../config/application.php';

class CurrencyConverter
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
        return number_format(floatval($value), DECIMALS);
    }

    private function loadRates()
    {
        $this->rates = json_decode(file_get_contents(RATES_FILE), true);
    }

    private function loadSymbols()
    {
        $this->symbols = json_decode(file_get_contents(SYMBOLS_FILE), true);
    }

    public function convert()
    {
        $rate = $this->currencyFormatter($this->rates[$this->from][$this->to]);
        $converted_value = $this->currencyFormatter($this->value * $rate);

        $convertion['original_value'] = "{$this->symbols[$this->from]} $this->value";
        $convertion['converted_value'] = "{$this->symbols[$this->to]} $converted_value";

        return json_encode($convertion);
    }
}

$currency_converter = new CurrencyConverter($_GET['from'], $_GET['to'], $_GET['value']);

echo $currency_converter->convert();
