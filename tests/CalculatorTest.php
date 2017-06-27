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
        $rates = $this->getPropertyValue($this->calculator, 'rates');

        $this->assertInternalType('array', $rates);
    }

    public function testLoadSymbolsShouldSetAnArray(): void
    {
        $symbols = $this->getPropertyValue($this->calculator, 'symbols');

        $this->assertInternalType('array', $symbols);
    }

    public function testCalculateShouldReturnAnArray(): void
    {
        $conversion = $this->calculator->calculate('USD', 'BRL', 3.45);

        $this->assertInternalType('array', $conversion);
    }

    public function testCalculateShouldReturnOriginalValue(): void
    {
        $conversion = $this->calculator->calculate('USD', 'BRL', 3.45);

        $this->assertEquals('$ 3.45', $conversion['original_value']);
    }

    public function testCalculateShouldReturnConvertedValue(): void
    {
        $conversion = $this->calculator->calculate('USD', 'BRL', 3.45);

        $this->assertEquals('R$ 6.90', $conversion['converted_value']);
    }

    public function testSetParamsShouldSetFrom(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $from = $this->getPropertyValue($this->calculator, 'from');

        $this->assertEquals('USD', $from);
    }

    public function testSetParamsShouldSetTo(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $to = $this->getPropertyValue($this->calculator, 'to');

        $this->assertEquals('BRL', $to);
    }

    public function testSetParamsShouldSetValue(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $value = $this->getPropertyValue($this->calculator, 'value');

        $this->assertEquals(3.45, $value);
    }

    public function testGetRateShouldReturnAFloat(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $rate = $this->invokeMethod($this->calculator, 'getRate');

        $this->assertInternalType('float', $rate);
    }

    public function testGetRateShouldReturnRate(): void
    {
        $this->invokeMethod($this->calculator, 'setParams', array('USD', 'BRL', 3.45));

        $rate = $this->invokeMethod($this->calculator, 'getRate');

        $this->assertEquals(2.0, $rate);
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

    public function testFormatShouldReturnAString(): void
    {
        $formatted_number = $this->invokeMethod($this->calculator, 'format', array(3.45));

        $this->assertInternalType('string', $formatted_number);
    }

    public function testFormatShouldReturnAFormattedNumberWithTwoDecimals(): void
    {
        $formatted_number = $this->invokeMethod($this->calculator, 'format', array(3.4536));

        $this->assertEquals('3.45', $formatted_number);
    }
}
