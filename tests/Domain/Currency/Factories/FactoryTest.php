<?php

namespace App\Test\Domain\Currency\Factories;

use App\Domain\Currency\Factories\CurrencyFactory;
use App\Domain\Currency\Interfaces\CurrencyInterface;

use InvalidArgumentException;

final class FactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testInvalidCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);
        CurrencyFactory::create('AUD');
    }

    public function testValidCurrency(): void
    {
        $currency = CurrencyFactory::create('BRL');
        $this->assertInstanceOf(CurrencyInterface::class, $currency);
    }
}
