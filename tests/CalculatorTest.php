<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once('TestCase.php');
require_once('src/Calculator.php');

class CalculatorTest extends TestCase
{
    protected $calculator;

    protected function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function testLoadRatesShouldSetAnArray(): void
    {
        $this->assertInternalType('array', $this->getPropertyValue($this->calculator, 'rates'));
    }

    public function testLoadSymbolsShouldSetAnArray(): void
    {
        $this->assertInternalType('array', $this->getPropertyValue($this->calculator, 'symbols'));
    }

    public function testCalculateShouldReturnAnArray(): void
    {
        $this->assertInternalType('array', $this->calculator->calculate('USD', 'BRL', 3.45));
    }

    public function testCalculateShouldReturnOriginalValue(): void
    {
        $this->assertEquals(
            '$ 3.45',
            $this->calculator->calculate('USD', 'BRL', 3.45)['original_value']
        );
    }

    public function testCalculateShouldReturnConvertedValue(): void
    {
        $this->assertEquals(
            'R$ 6.90',
            $this->calculator->calculate('USD', 'BRL', 3.45)['converted_value']
        );
    }

    public function testSetParamsShouldSetFrom(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $this->assertEquals('USD', $this->getPropertyValue($this->calculator, 'from'));
    }

    public function testSetParamsShouldSetTo(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $this->assertEquals('BRL', $this->getPropertyValue($this->calculator, 'to'));
    }

    public function testSetParamsShouldSetValue(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $this->assertEquals(3.45, $this->getPropertyValue($this->calculator, 'value'));
    }

    public function testGetRateShouldReturnAFloat(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $this->assertInternalType('float', $this->invokeMethod($this->calculator, 'getRate'));
    }

    public function testGetRateShouldReturnRate(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $this->assertEquals(2.0, $this->invokeMethod($this->calculator, 'getRate'));
    }

    public function testGetRateShouldRaiseExceptionForUnknownFrom(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('AUD', 'BRL', 3.45));

        $this->expectException(RateNotFoundException::class);

        $rate = $this->invokeMethod($this->calculator, 'getRate');
    }

    public function testGetRateShouldRaiseExceptionForUnknownTo(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'AUD', 3.45));

        $this->expectException(RateNotFoundException::class);

        $rate = $this->invokeMethod($this->calculator, 'getRate');
    }

    public function testGetRateShouldRaiseExceptionForRateNotFound(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'EUR', 3.45));

        $this->expectException(RateNotFoundException::class);

        $rate = $this->invokeMethod($this->calculator, 'getRate');
    }

    public function testFormatShouldReturnAString(): void
    {
        $this->assertInternalType(
            'string',
            $this->invokeMethod($this->calculator, 'format', array(3.45))
        );
    }

    public function testFormatShouldReturnAFormattedNumberWithTwoDecimals(): void
    {
        $this->assertEquals(
            '3.45',
            $this->invokeMethod($this->calculator, 'format', array(3.4536))
        );
    }
}
