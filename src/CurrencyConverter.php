<?php
require_once('CurrencyValidator.php');

class CurrencyConverter
{
    private $currency_from;
    private $currency_to;
    private $exchange;
    private $value;
    private $prefix;
    private $status = 200;

    function __construct($currency_from, $currency_to, $exchange, $value){
        $this->currency_from = strtolower($currency_from);
        $this->currency_to = strtolower($currency_to);
        $this->setExchange($exchange);
        $this->value = $value;
        $this->validator = new CurrencyValidator($currency_from, $currency_to, $exchange, $value);
    }

    private function setExchange($exchange){
        if (!isset($exchange) && ($this->currency_to == 'brl')){
            $url = 'https://economia.awesomeapi.com.br/json/' . $this->currency_from . '-' . $this->currency_to . '/1';
            $response = file_get_contents($url);
            $response = json_decode($response, true);
            $exchange = $response[0]['bid'];
        }
        settype($exchange, 'float');
        $this->exchange = $exchange;
    }

    private function setPrefix(){
        if ($this->currency_to == 'brl'){
            $this->prefix = 'R$';
        }
        elseif ($this->currency_to == 'usd'){
            $this->prefix = 'US$';
        }
        elseif ($this->currency_to == 'eur'){
            $this->prefix = '€';
        }
    }

    function build(){
        if ($this->validator->isValid()){
            $this->setPrefix();
            $this->converted = $this->convert();
            return array('symbol' => $this->prefix, 'value' => $this->converted);
        }
        else {
            $this->status = 400;
            return array('errors' => $this->validator->errors());
        }
    }

    function status(){
        return $this->status;
    }

    private function convert(){
        return $this->exchange * $this->value;
    }
}
?>
