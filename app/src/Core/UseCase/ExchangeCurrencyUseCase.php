<?php

namespace App\Core\UseCase;

use App\Core\Entities\ICurrency;

class ExchangeCurrencyUseCase implements IUseCase
{
    public function execute(ICurrency $from, ICurrency $to, float $value, float $cotation)
    {
        $res = [
            "symbol" => $to->getSymbol(),
            "value" =>  floatval(($value * $cotation))
        ];

        return json_encode($res);
    }
}
