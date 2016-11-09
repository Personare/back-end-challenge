<?php
namespace CoinConversion\Currency;

class BrlCurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testIdAndSymbol()
    {
        // setup
        $expectedId = 'BRL';
        $expectedSymbol = 'R$';

        // execution
        $currency = new BrlCurrency();

        // assertions
        $this->assertEquals($expectedId, $currency->getId());
        $this->assertEquals($expectedSymbol, $currency->getSymbol());
    }
}
