<?php
namespace App\Services;

use App\Factory\CurrencyFactory;
use App\Domain\Currency\Interfaces\CurrencyInterface;
use GuzzleHttp\Client;

class ExchangeRateApiService
{
    protected $client;
    protected $data;

    public function __construct() 
    {
        $this->client = new Client(['base_uri' => 'https://api.exchangeratesapi.io/latest']);
    }

    public function exchange(array $data) : array
    {
        $exchangeData = 
            json_decode($this->client->get('?base='.$data['currencyFrom'])
                ->getBody()
                ->getContents()
            );

        $data['rate'] = $exchangeData->rates->{$data['currencyTo']};

        return $data;
    }

}
