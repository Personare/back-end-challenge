<?php
class CurrencyConverter
{
    private $exchange;
    private $value;
    private $prefix;
    private $status = 200;
    private $hasErrors = false;
    private $errors = [];
    private $acceptable_currencies = ['brl', 'usd', 'eur'];

    function __construct($currency_from, $currency_to, $exchange, $value){
        $this->currency_from = strtolower($currency_from);
        $this->currency_to = strtolower($currency_to);
        $this->setExchange($exchange);
        $this->value = $value;
    }

    private function setExchange($exchange){
        if (!isset($exchange)){
            if ($this->currency_to == 'brl'){
                $url = 'https://economia.awesomeapi.com.br/json/' . $this->currency_from . '-' . $this->currency_to . '/1';
                $response = file_get_contents($url);
                $response = json_decode($response, true);
                $exchange = $response[0]['bid'];
            }
            else {
                $this->setError('Se você não passar o exchange o currency_to precisa ser "brl"');
            }
        }
        settype($exchange, 'float');
        $this->exchange = $exchange;
    }

    private function setError($msg){
        $this->hasErrors = true;
        $this->errors[] = $msg;
        $this->status = 400;
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
        $this->validate();
        if ($this->hasErrors){
            return array('errors' => $this->errors);
        }
        else {
            $this->setPrefix();
            $this->converted = $this->convert();
            return array('symbol' => $this->prefix, 'value' => $this->converted);
        }
    }

    function status(){
        return $this->status;
    }

    private function validate(){
        $this->validateRequiredParams();
        $this->validateCurrency();
        $this->validateBrl();
    }

    private function validateRequiredParams(){
        if (!isset($this->currency_to) || !isset($this->currency_from) || !isset($this->value)){
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

    private function validateBrl(){
        if ($this->currency_to != 'brl' && $this->currency_from != 'brl'){
            $this->setError('Uma das moedas deve ser Real');
        }
    }

    private function convert(){
        return $this->exchange * $this->value;
    }
}
?>
