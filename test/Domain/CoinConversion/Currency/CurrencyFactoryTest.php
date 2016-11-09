<?php


namespace CoinConversion\Currency;


class CurrencyFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildCurrencies()
    {
        // execution
        $brlCurrency = CurrencyFactory::build('BRL');
        $usdCurrency = CurrencyFactory::build('USD');
        $eurCurrency = CurrencyFactory::build('EUR');

        // assertions
        $this->assertInstanceOf(BrlCurrency::class, $brlCurrency);
        $this->assertInstanceOf(UsdCurrency::class, $usdCurrency);
        $this->assertInstanceOf(EurCurrency::class, $eurCurrency);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Not found currency type 'JEP'.
     */
    public function testWrongCurrencyValue()
    {
        // execution
        CurrencyFactory::build('JEP');
    }
}
