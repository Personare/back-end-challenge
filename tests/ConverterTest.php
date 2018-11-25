<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ConverterTest extends TestCase
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

    public function testConverterShouldConvertBRLToUSD()
    {
        $this->get('/converter/BRL/USD?value=1');
        $this->seeStatusCode(200);
        $this->seeJsonEquals([
            'origina"l' => "R$ 1.00",
            'converted' => "$ 0.26",

         ]);


    }




}
