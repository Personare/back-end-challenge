<?php declare(strict_types = 1);

namespace App\Test\Service;

use App\Entity\Currency\Dollar;
use App\Entity\Currency\Euro;
use App\Entity\Currency\Real;
use App\Service\Exchange;

final class ExchangeTest extends \PHPUnit\Framework\TestCase
{
    private Exchange $service;

    public function setUp(): void
    {
        $this->service = new Exchange;
    }

    public function testNotAllowedConversion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service
            ->setFrom(new Euro)
            ->setTo(new Dollar)
            ->getConvertedData(1, 1);
    }

    public function testNegativeAmmount(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service
            ->setFrom(new Real)
            ->setTo(new Dollar)
            ->getConvertedData(-1, 1);
    }

    public function testNegativeRate(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service
            ->setFrom(new Real)
            ->setTo(new Dollar)
            ->getConvertedData(1, -1);
    }

    public function testSuccessConversion(): void
    {
        $convertedData = $this->service
            ->setFrom(new Real)
            ->setTo(new Dollar)
            ->getConvertedData(1, 5);

        $this->assertEquals(
            $convertedData,
            [
                'valorConvertido' => 5,
                'simboloMoeda' => '$',
            ],
        );
    }
}
