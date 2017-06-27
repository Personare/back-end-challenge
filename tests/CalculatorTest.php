<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once('TestCase.php');
require_once('src/Calculator.php');

class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    protected $calculator;

    protected function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function getPropertyValue(&$object, $propertyName)
    {
        $class_name = get_class($object);
        $reflection = new \ReflectionClass($class_name);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue(new $class_name);
    }

    public function testLoadRatesShouldSetAnArray(): void
    {
        $this->invokeMethod($this->calculator, 'loadRates');

        $rates = $this->getPropertyValue($this->calculator, 'rates');

        $this->assertInternalType('array', $rates);
    }

    public function testCalculateShouldReturnsAnArray(): void
    {
        # mocar tests
        # parametros em variaveis

        $conversion = $this->calculator->calculate('BRL', 'USD', 2.0);

        $this->assertInternalType('array', $conversion);
    }
}
