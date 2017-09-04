<?php

namespace Tests\Domain\Services;

use Domain\Services\ExchangeRate;
use Tests\TestBase;

class ExchangeRateTest extends TestBase
{
    private $service;

    protected function setUp()
    {
        $this->service = $this->app()->get(ExchangeRate::class);
    }

    public function testServiceExists()
    {
        $this->assertInstanceOf(ExchangeRate::class, $this->service);
    }

    /**
     * @dataProvider getData
     */
    public function testExchangeRateConvertion($value, $rate, $exchange, $expected)
    {
        $this->service->amount($value);
        $this->service->rate($rate);

        $this->assertEquals($expected, $this->service->convertion() === $exchange);
    }

    public function getData(): array
    {
        return [
            [1, 3.13, 3.13, true],
            [2, 3.13, 3.13, false],
            [10, 2.00, 20.00, true],
            [100, 0.40, 32.00, false],
            [35, 0.23, 8.05, true],
        ];
    }
}