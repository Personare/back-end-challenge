<?php

use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    public function testCorrectValueReturned(){
        $cc = new CurrencyConverter('usd', 'brl', 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals(2, $retured_value["value"]);
        $this->assertEquals(200, $cc->status());
    }

    public function testCorrectValueReturnedWithoutExchange(){
        # TODO: Needs internet connection. Mock?
        $cc = new CurrencyConverter('eur', 'brl', null, 2);
        $retured_value = $cc->build();

        $this->assertInternalType('float', $retured_value["value"]);
        $this->assertEquals(200, $cc->status());
    }

    public function testCorrectSymbolReturnedForBRL(){
        $cc = new CurrencyConverter('usd', 'brl', 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals('R$', $retured_value["symbol"]);
        $this->assertEquals(200, $cc->status());
    }

    public function testCorrectSymbolReturnedForUSD(){
        $cc = new CurrencyConverter('brl', 'usd', 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals('US$', $retured_value["symbol"]);
        $this->assertEquals(200, $cc->status());
    }

    public function testCorrectSymbolReturnedForEUR(){
        $cc = new CurrencyConverter('brl', 'eur', 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals('€', $retured_value["symbol"]);
        $this->assertEquals(200, $cc->status());
    }
}
