<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once('TestCase.php');
require_once('src/Calculator.php');

class CalculatorTest extends TestCase
{
    public function testCalculateReturnsAnArray(): void
    {
        # mocar tests
        # parametros em variaveis

        $calculator = new Calculator();

        $conversion = $calculator->calculate('BRL', 'USD', 2.0);

        $this->assertInternalType('array', $conversion);
    }
}
