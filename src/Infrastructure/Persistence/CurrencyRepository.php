<?php
namespace PersonareExchange\Infrastructure\Persistence;

use GuzzleHttp\Client;
use PersonareExchange\Domain\Entities\Currency;
use PersonareExchange\Domain\Repositories\ICurrencyRepository;

class CurrencyRepository implements ICurrencyRepository
{
    private $http;

    public function __construct()
    {
        $this->http = new Client(['base_uri' => 'http://data.fixer.io/api']);
    }

    public function findQuoteFromCode($code): Currency
    {
        try {
            $response = $this->http->request('GET', '/latest', ['query' => ['access_key' => '322e8613f99d41e1d11c75c315092723', 'codes' => $code, 'format' => 1]]);
            $jsonResponse = $response->getBody()->read(1024);
            $data = json_decode($jsonResponse, true);
            $currency = new Currency();
            $currency->setCode($code);
            $currency->setValue($data['rates'][$code]);
            return $currency;
        } catch (\Exception $ex) {
            throw new \Exception("Can't convert values");
        }
    }

    private function quoteFromCode()
    {

    }
}
