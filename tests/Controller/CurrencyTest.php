<?php

namespace App\Test\Controller;

use App\Controller\ApiController;
use App\Service\CurrencyService;
use App\Http\Response\JsonResponse;

final class CurrencyTest extends \PHPUnit\Framework\TestCase
{
    /** @runInSeparateProcess */
    public function testInvalidMethod(): void
    {
        /**
         * @var \App\Controller\ApiController&\PHPUnit\Framework\MockObject\MockObject $currency
         * */
        $currency = $this->getMockBuilder(ApiController::class)
            ->setConstructorArgs([new CurrencyService, new JsonResponse])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $currency->method('getRequestUri')->willReturn(['http://localhost:8000']);

        $currency->personareApi();

        $this->expectOutputString('{"message":"Wrong params. Use \/currency"}');
    }

    /** @runInSeparateProcess */
    public function testSuccess(): void
    {
        /**
         * @var \App\Controller\ApiController&\PHPUnit\Framework\MockObject\MockObject $currency
         * */
        $currency = $this->getMockBuilder(ApiController::class)
            ->setConstructorArgs([new CurrencyService, new JsonResponse])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $currency->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'currency', '100', 'BRL', 'USD', '5']);

        $currency->personareApi();

        $this->expectOutputString('{"convertedValue":20,"currencySymbol":"$"}');
    }
}
