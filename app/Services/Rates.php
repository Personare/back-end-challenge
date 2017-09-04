<?php

namespace App\Services;

use GuzzleHttp\Client;

class Rates
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Rate constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $base
     * @param string $to
     * @return bool
     * @throws \RuntimeException
     */
    public function get(string $base, string $to)
    {
        $base = strtoupper($base);
        $to = strtoupper($to);

        $response = $this->client->get("http://api.fixer.io/latest?base=$base");

        if ($response->getStatusCode() === 200) {
            $content = json_decode($response->getBody()->getContents());

            return $content->rates->{$to};
        }

        return false;
    }
}