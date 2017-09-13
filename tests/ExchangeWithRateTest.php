<?php

namespace Tests;

class ExchangeWithRateTest extends TestBase
{
    public function testExchangeWithRateBrlUsd()
    {
        $response = $this->client->get('/BRL/USD/1/1');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithRate($response, $data, 'R$ 1,00', '$ 1,00');
    }

    public function testExchangeWithRateUsdBrl()
    {
        $response = $this->client->get('/USD/BRL/1/1');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithRate($response, $data, '$ 1,00', 'R$ 1,00');
    }

    public function testExchangeWithRateBrlEur()
    {
        $response = $this->client->get('/BRL/EUR/1/1');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithRate($response, $data, 'R$ 1,00', '€ 1,00');
    }

    public function testExchangeWithRateEurBrl()
    {
        $response = $this->client->get('/EUR/BRL/1/1');
        $data = json_decode($response->getBody(true), true);

        $this->assertWithRate($response, $data, '€ 1,00', 'R$ 1,00');
    }
}