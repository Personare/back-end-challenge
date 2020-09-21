<?php
namespace App\Services;

use App\Factory\CurrencyFactory;
use App\Domain\Currency\Interfaces\CurrencyInterface;

class CurrencyService
{
    protected CurrencyInterface $currencyTo;

    public function convert(array $data) : array 
    {
        $this->currencyTo = CurrencyFactory::create($data['currencyTo']);

        if (!isset($data['rate'])) { 
            try {
                $data = (app(ExchangeRateApiService::class))->exchange($data);
                $data['value'] = $data['rate'] * $data['amount'];
                $data['symbol'] = $this->currencyTo->getSymbol();   

             } catch (\Throwable $th) {
                throw $th;
             }

            return $data;
        }

        $data['value'] = $data['rate'] * $data['amount'];
        $data['symbol'] = $this->currencyTo->getSymbol();

        return $data;
    }
}
