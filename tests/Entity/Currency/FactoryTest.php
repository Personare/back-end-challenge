<?php declare(strict_types = 1);

namespace App\Test\Entity\Currency;

use App\Entity\Currency\Factory;
use App\Entity\Currency\ICurrency;

final class FactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateInvalidCurrency(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Factory::create('BLR');
    }

    public function testCreateValidCurrency(): void
    {
        $currency = Factory::create('BRL');
        $this->assertInstanceOf(ICurrency::class, $currency);
    }
}
