<?php

namespace App;

class Converter
{
    private $from;
    private $to;
    private $value;
    private $convertedValue;

    private $SUPPORTED_CURRENCIES = ['BRL', 'USD', 'EUR'];
    private $CURRENCIES = [
           'BRL' => [
                'SYMBOL' => 'R$',
                'RATES' => [
                    'USD' => 0.26,
                    'EUR' => 0.23
                ]
           ],
           'EUR' => [
               'SYMBOL' => '€',
               'RATES' => [
                   'BRL' => 4.35,
                   'USD' => 1.13
               ]
           ],
           'USD' => [
               'SYMBOL' => '$',
               'RATES' => [
                   'BRL' => 3.83,
                   'EUR' => 0.88
               ]
           ]
           ];

    public function __construct($from, $to, $value)
    {
        if(!$this->validateCurrency($from)){
            throw new \InvalidArgumentException("Not supported currency on 'from' parameter");
        }

        if(!$this->validateCurrency($to)){
            throw new \InvalidArgumentException("Not supported currency on 'to' parameter");
        }

        if(!$value){
            throw new \InvalidArgumentException("Missing 'value' parameter");
        }

        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
        $this->convertedValue =  $value * $this->getRate();
    }



    public function getFormatted($attr){
        switch($attr){
            case 'from' : return $this->formatCurrency($this->value, $this->from);
            case 'to' : return $this->formatCurrency($this->convertedValue, $this->to);
            default: return null;
        }
    }

    public function getRate(){
        return $this->CURRENCIES[$this->from]['RATES'][$this->to];
    }

    private function formatCurrency($value, $currency){
        return $this->CURRENCIES[$currency]['SYMBOL'] . ' ' . number_format($value, 2, '.' , ',');
    }

    private function validateCurrency($currency)
    {
        return in_array($currency, $this->SUPPORTED_CURRENCIES);
    }

}
