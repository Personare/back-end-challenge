<?php

namespace App\Test\Service;

use App\Domain\Currency\Dollar;
use App\Domain\Currency\Euro;
use App\Domain\Currency\Real;
use App\Service\CurrencyService;

use InvalidArgumentException;

final class CurrencyTest extends \PHPUnit\Framework\TestCase
{
    private CurrencyService $service;

    public function setUp(): void
    {
        $this->service = new CurrencyService;
    }

    public function testCantConvert(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->service->setFrom(new Euro)->setTo(new Dollar)
            ->getConversion(100, 5);
    }

    public function testCanConvert(): void
    {
        $conversion = $this->service->setFrom(new Real)->setTo(new Dollar)
            ->getConversion(100, 5.58);

        $this->assertEquals($conversion,
            [
                'convertedValue' => 17.92,
                'currencySymbol' => '$'
            ]
        );
    }
}
