<?php

namespace App\Business;

class CurrencyBusiness
{
    private $currency_from;
    private $currency_to;
    private $value;
    
    public function __construct($currency_from, $currency_to, $value)
    {
        $this->currency_from = $currency_from;
        $this->currency_to = $currency_to;
        $this->value = $value;
    }
    
    public function convertCurrency($objFrom, $objTo)
    {
        
        if ($objFrom->name == "Real") {
            $value = number_format($this->value / $objTo->exchange_rate, 2, ".", ",");
        } else {
            $value = number_format($this->value * $objFrom->exchange_rate, 2, ",", ".");
        }
        
        return ["value" => $value,
            "symbol" => $objTo->symbol,
            "formatted" => $objTo->symbol . " " . $value,
        ];
    }
    
    public function validateData($objFrom, $objTo)
    {
        
        if (empty($objFrom)) {
            return response()->json(["error" => "Currency ".$this->currency_from." not found!"]);
        }
        
        if (empty($objTo)) {
            return response()->json(["error" => "Currency ".$this->currency_to." not found!"]);
        }
        
        if ($objFrom->name !== "Real" && $objTo->name !== "Real") {
            return response()->json(["error" => "The origin or destination currency should be Real!"]);
        }
        
        if ($objFrom->name == $objTo->name) {
            return response()->json(["error" => "The origin and destination currencies can not be the same!"]);
        }
        
        return $this->validateValue();
    }
    
    public function validateValue()
    {
        if (empty($this->value)) {
            return response()->json(["error" => "The value should not be empty!"]);
        }
        
        if (!is_numeric($this->value)) {
            return response()->json(["error" => "The value should be numeric!"]);
        }
        
        if ($this->value < 0) {
            return response()->json(["error" => "The value should be positive!"]);
        }
        
        return true;
    }
}
