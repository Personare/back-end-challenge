<?php

namespace App\Business;

class CurrencyBusiness
{
    public function convertCurrency($from, $to, $value)
    {

        if ($from->name == "Real") {
            $value = number_format($value / $to->exchange_rate, 2, ".", ",");
        } else {
            $value = number_format($value * $from->exchange_rate, 2, ",", ".");
        }
        
        return ["value" => $value,
                "symbol" => $to->symbol,
                "formatted" => $to->symbol . " " . $value,
            ];
    }
    
    public function validateData($from, $to, $currency_from, $currency_to, $value)
    {
        
        if (empty($from)) {
            return response()->json(["error" => "Currency ".$currency_from." not found!"]);
        }
        
        if (empty($to)) {
            return response()->json(["error" => "Currency ".$currency_to." not found!"]);
        }
        
        if ($from->name !== "Real" && $to->name !== "Real") {
            return response()->json(["error" => "The origin or destination currency should be Real!"]);
        }
        
        if ($from->name == $to->name) {
            return response()->json(["error" => "The origin and destination currencies can not be the same!"]);
        }
        
        if (empty($value)) {
            return response()->json(["error" => "The value should not be empty!"]);
        }
        
        if (!is_numeric($value)) {
            return response()->json(["error" => "The value should be numeric!"]);
        }
        
        if ($value < 0) {
            return response()->json(["error" => "The value should be positive!"]);
        }
        
        return true;
    }
}
