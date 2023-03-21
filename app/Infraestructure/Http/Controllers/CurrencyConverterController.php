<?php

declare(strict_types=1);

namespace App\Infraestructure\Http\Controllers;

use App\Domain\Currency\Entities\Currency;
use App\Domain\Currency\Enums\CurrencyEnum;
use App\Domain\Currency\Exceptions\CurrencyException;
use App\Lib\Request;
use App\Lib\Response;
use App\Service\Currency\Convert\CurrencyConverterService;

class CurrencyConverterController
{
    public function handle(Request $request, Response $response)
    {
        try {
            $body = $request->getJSON();

            $currencyResponse = (new CurrencyConverterService())->convert(
                $body->amount,
                Currency::create(CurrencyEnum::fromString($body->from)),
                Currency::create(CurrencyEnum::fromString($body->to)),
                $body->tax
            );

            return $response->toJSON([
                'symbol' => $currencyResponse->getCurrency()->getSymbol(),
                'value' => $currencyResponse->getValue(),
            ]);
        } catch (CurrencyException $exception) {
            $response->status(400);

            return $response->toJSON([
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
