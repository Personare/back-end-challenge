<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once('TestCase.php');
require_once('src/Calculator.php');

class CalculatorTest extends TestCase
{
    public function testCalculateReturnsAnArray(): void
    {
        $calculator = new Calculator('BRL', 'USD', 2.0);

        $conversion = $calculator->calculate();

        $this->assertInternalType('array', $conversion);
    }
}
