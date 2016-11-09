<?php
namespace CoinConversion\Currency;

class UsdCurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testIdAndSymbol()
    {
        // setup
        $expectedId = 'USD';
        $expectedSymbol = '$';

        // execution
        $currency = new UsdCurrency();

        // assertions
        $this->assertEquals($expectedId, $currency->getId());
        $this->assertEquals($expectedSymbol, $currency->getSymbol());
    }
}
