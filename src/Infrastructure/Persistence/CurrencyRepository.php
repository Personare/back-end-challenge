<?php
namespace PersonareExchange\Infrastructure\Persistence;

use PersonareExchange\Domain\Repositories\ICurrencyRepository;
use GuzzleHttp\Client;
use PersonareExchange\Domain\Entities\Exchange;
use PersonareExchange\Domain\Entities\Currency;

class CurrencyRepository implements ICurrencyRepository
{
  private $http;

  public function __construct()
  {
    $this->http = new Client(['base_uri' => 'http://data.fixer.io/api']);
  }

  public function findRateFromSymbol($symbol) : ? Currency
  {
    $response = $this->http->request('GET', '/latest', ['query' => ['access_key' => '322e8613f99d41e1d11c75c315092723', 'symbols' => $symbol, 'format' => 1]]);
    $jsonResponse = $response->getBody()->read(1024);
    $data = json_decode($jsonResponse, true);
    $currency = new Currency();
    $currency->setSymbol($symbol);
    $currency->setValue($data['rates'][$symbol]);
    return $currency ? : null;
  }
}