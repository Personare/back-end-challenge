<?php
namespace CoinConversion\Currency;

class EurCurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testIdAndSymbol()
    {
        // setup
        $expectedId = 'EUR';
        $expectedSymbol = '€';

        // execution
        $currency = new EurCurrency();

        // assertions
        $this->assertEquals($expectedId, $currency->getId());
        $this->assertEquals($expectedSymbol, $currency->getSymbol());
    }
}
