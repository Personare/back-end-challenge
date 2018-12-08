<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Currency;
use App\Business\CurrencyBusiness;

class CurrencyController extends Controller
{
    public function getCurrencyConvertedValue($currency_from, $currency_to, $value)
    {
        $from = Currency::where('name', $currency_from)->first();
        $to = Currency::where('name', $currency_to)->first();

        $objCurrencyBusiness = new CurrencyBusiness();
        $validateData = $objCurrencyBusiness->validateData($from, $to, $currency_from, $currency_to, $value);
        
        if($validateData !== true) {
            return $validateData;
        }
        
        return response()->json($objCurrencyBusiness->convertCurrency($from, $to, $value));
    }
}
