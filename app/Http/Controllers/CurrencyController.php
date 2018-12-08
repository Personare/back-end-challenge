<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Currency;
use App\Business\CurrencyBusiness;

class CurrencyController extends Controller
{
    public function getCurrencyConvertedValue($currency_from, $currency_to, $value)
    {
        $objFrom = Currency::where('name', $currency_from)->first();
        $objTo = Currency::where('name', $currency_to)->first();

        $objCurrencyBusiness = new CurrencyBusiness($currency_from, $currency_to, $value);
        $validateData = $objCurrencyBusiness->validateData($objFrom, $objTo);
        
        if ($validateData !== true) {
            return $validateData;
        }
        
        return response()->json($objCurrencyBusiness->convertCurrency($objFrom, $objTo));
    }
}
