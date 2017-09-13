<?php

namespace Tests;

class ExchangeWithoutRateTest extends TestBase
{
    public function testExchangeWithoutRateBrlUsd()
    {
        $response = $this->client->get('/BRL/USD/10');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithoutRate($response, $data, 'R$', '$');
    }

    public function testExchangeWithoutRateUsdBrl()
    {
        $response = $this->client->get('/USD/BRL/10');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithoutRate($response, $data, '$', 'R$');
    }

    public function testExchangeWithoutRateBrlEur()
    {
        $response = $this->client->get('/BRL/EUR/10');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithoutRate($response, $data, 'R$', '€');
    }

    public function testExchangeWithoutRateEurBrl()
    {
        $response = $this->client->get('/EUR/BRL/10');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithoutRate($response, $data, '€', 'R$');
    }
}