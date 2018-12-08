<?php

namespace App\Business;

class CurrencyBusiness
{
    public function convertCurrency($objFrom, $objTo, $value)
    {

        if ($objFrom->name == "Real") {
            $value = number_format($value / $objTo->exchange_rate, 2, ".", ",");
        } else {
            $value = number_format($value * $objFrom->exchange_rate, 2, ",", ".");
        }
        
        return ["value" => $value,
                "symbol" => $objTo->symbol,
                "formatted" => $objTo->symbol . " " . $value,
            ];
    }
    
    public function validateData($objFrom, $objTo, $currency_from, $currency_to, $value)
    {
        
        if (empty($objFrom)) {
            return response()->json(["error" => "Currency ".$currency_from." not found!"]);
        }
        
        if (empty($objTo)) {
            return response()->json(["error" => "Currency ".$currency_to." not found!"]);
        }
        
        if ($objFrom->name !== "Real" && $objTo->name !== "Real") {
            return response()->json(["error" => "The origin or destination currency should be Real!"]);
        }
        
        if ($objFrom->name == $objTo->name) {
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
