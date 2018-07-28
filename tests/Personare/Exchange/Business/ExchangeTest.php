<?php

namespace Personare\Exchange\Business;

use Personare\Exchange\DataAccess\CurrencyDAO;
use Personare\Exchange\DataAccess\Entity\Currency;
use PHPUnit\Framework\TestCase;


class ExchangeTest extends TestCase
{
    protected $currencyDao;

    public function setUp()
    {
        $this->currencyDao = $this->createMock(CurrencyDAO::class);

        $this->currencyDao->method('loadFromCode')
            ->will($this->returnCallback(function ($arg) {
                $currency = new Currency();
                if ($arg === 'USD') {
                    $currency->setCode('USD');
                    $currency->setSymbol('$');
                    $currency->setValue('4.000');
                    $currency->setBase(false);
                } else {
                    $currency->setCode('BRL');
                    $currency->setSymbol('R$');
                    $currency->setValue('1.000');
                    $currency->setBase(true);
                }
                return $currency;
            }));
    }

    public function testAssertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Personare\Exchange\Business\Exchange'),
            'Class not found: ' . $class
        );
    }

    public function testConvertValueShouldReturn4IfTheConvertionFrom1UsdToBrl()
    {
        $exchange = new Exchange(($this->currencyDao));
        $expected = $exchange->from('USD');
        $expected = $exchange->to('BRL');

        $expected = $exchange->convertValue(1);

        $this->assertEquals(4, $expected);
    }

    public function testConvertValueShouldReturn5IfTheConvertionFrom20BrlToUsd()
    {
        $exchange = new Exchange(($this->currencyDao));
        $expected = $exchange->from('BRL');
        $expected = $exchange->to('USD');

        $expected = $exchange->convertValue(20);

        $this->assertEquals(5, $expected);
    }

    public function testSetFromCurrencyShouldReturnCurrentInstance()
    {
        $exchange = new Exchange($this->currencyDao);
        $expected = $exchange->from('USD');

        $this->assertInstanceOf("Personare\Exchange\Business\Exchange", $expected);
    }

    public function testSetToCurrencyShouldReturnCurrentInstance()
    {
        $exchange = new Exchange($this->currencyDao);
        $expected = $exchange->to('BRL');

        $this->assertInstanceOf("Personare\Exchange\Business\Exchange", $expected);
    }
}
