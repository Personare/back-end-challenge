<?php

class CurrencyValidator
{
    private $currency_from;
    private $currency_to;
    private $exchange;
    private $value;
    private $valid = true;
    private $errors = [];
    private $acceptable_currencies = ['brl', 'usd', 'eur'];

    function __construct($currency_from, $currency_to, $exchange, $value){
        $this->currency_from = strtolower($currency_from);
        $this->currency_to = strtolower($currency_to);
        $this->exchange = $exchange;
        $this->value = $value;
    }

    function isValid(){
        $this->validateRequiredParams();
        $this->validateCurrency();
        $this->validateBrl();
        return $this->valid;
    }

    function errors(){
        return $this->errors;
    }

    private function validateRequiredParams(){
        if (empty($this->currency_to) || empty($this->currency_from) || empty($this->value)){
            $this->setError('Faltam parâmetros obrigatórios');
        }
    }

    private function validateCurrency(){
        if (!in_array($this->currency_to, $this->acceptable_currencies) ||
            !in_array($this->currency_from, $this->acceptable_currencies)){
                $this->setError('Apenas suportamos as seguintes moedas: ' . join(', ', $this->acceptable_currencies));
            }
        if ($this->currency_from == $this->currency_to){
            $this->setError('As moedas devem ser diferentes');
        }
    }

    private function validateExchange(){
        if (!isset($exchange) && $this->currency_to != 'brl'){
            $this->setError('Se você não passar o exchange o currency_to precisa ser "brl"');
        }
    }

    private function validateBrl(){
        if ($this->currency_to != 'brl' && $this->currency_from != 'brl'){
            $this->setError('Uma das moedas deve ser Real');
        }
    }

    private function setError($msg){
        $this->valid = false;
        $this->errors[] = $msg;
    }
}
?>
