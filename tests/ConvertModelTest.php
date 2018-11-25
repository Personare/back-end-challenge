<?php

use App\Converter;

class ConverterModelTest extends TestCase
{
    public function testShouldCreateOnlyWithValidCurrency()
    {
        $this->expectException(InvalidArgumentException::class);
        $converter = new Converter('BRL', 'BTC', 1);

        $this->expectException(InvalidArgumentException::class);
        $converter = new Converter('BTC', 'BRL', 1);
    }

    public function testShouldHaveAValueParameterOnConstruct()
    {
        $converter = new Converter('BRL', 'USD', 1);
        $this->assertInstanceOf(Converter::class, $converter);

        $this->expectException(InvalidArgumentException::class);
        $converter = new Converter('USD', 'BRL', null);
    }

    public function testShouldFormatCurrencyWithSymbol()
    {
        $converter = new Converter('BRL', 'USD', 1);

        $formattedCurrency = $converter->getFormatted('from');

        $this->assertEquals('R$ 1.00', $formattedCurrency);

    }

    public function testShouldReturnRateBetweenCurrencies()
    {
        $converter = new Converter('BRL', 'USD', 2);

        $rate = $converter->getRate('BRL', 'USD');

        $this->assertEquals(0.26, $rate);
    }






}
