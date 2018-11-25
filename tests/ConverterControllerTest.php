<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ConverterControllerTest extends TestCase
{

    public function testRouteExists()
    {
        $this->get('/converter/BRL/USD?value=4.50');
        $this->seeStatusCode(200);
    }

    public function testConverterShouldHaveValueParameter()
    {
        $this->get('/converter/BRL/USD');
        $this->seeStatusCode(400);

        $this->get('/converter/BRL/USD?value=4.50');
        $this->seeStatusCode(200);
    }

    public function testConverterShouldTestForValidCurrency()
    {
        $this->get('/converter/BRL/BTC?value=1');
        $this->seeStatusCode(400);

        $this->get('/converter/BTC/BRL?value=1');
        $this->seeStatusCode(400);
    }

    public function testConverterShouldConvertBrlToUsd()
    {
        $this->get('/converter/BRL/USD?value=1');
        $this->seeStatusCode(200);
        $this->seeJsonEquals([
            'original' => "R$ 1.00",
            'converted' => "$ 0.26",
            'rate' => 0.26
         ]);
    }

    public function testConverterShouldConvertUsdToBrl()
    {
        $this->get('/converter/USD/BRL?value=3.56');
        $this->seeStatusCode(200);
        $this->seeJsonEquals([
            'original' => "$ 3.56",
            'converted' => "R$ 13.63",
            'rate' => 3.83
         ]);
    }

    public function testConverterShouldConvertBrlToEur()
    {
        $this->get('/converter/BRL/EUR?value=1089');
        $this->seeStatusCode(200);
        $this->seeJsonEquals([
            'original' => "R$ 1,089.00",
            'converted' => "€ 250.47",
            'rate' => 0.23
         ]);
    }

    public function testConverterShouldConvertEurToBrl()
    {
        $this->get('/converter/EUR/BRL?value=753.67');
        $this->seeStatusCode(200);
        $this->seeJsonEquals([
            'original' => "€ 753.67",
            'converted' => "R$ 3,278.46",
            'rate' => 4.35
         ]);
    }





}
