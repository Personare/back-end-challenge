<?php declare(strict_types = 1);

namespace App\Test\Controller;

use App\Controller\Exchange;
use App\Service\Exchange as Service;
use App\Util\Responses;

final class ExchangeTest extends \PHPUnit\Framework\TestCase
{
    /** @runInSeparateProcess */
    public function testInvalidMethod(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Responses])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"M\u00e9todo n\u00e3o implementado!"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyValue(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Responses])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"Valor n\u00e3o informado!"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyFrom(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Responses])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange', '10']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"N\u00e3o informada a moeda de origem!"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyTo(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Responses])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange', '10', 'BRL']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"N\u00e3o informada a moeda de destino!"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyRate(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Responses])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange', '10', 'BRL', 'USD']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"Taxa de convers\u00e3o n\u00e3o foi informada!"}');
    }

    /** @runInSeparateProcess */
    public function testSuccess(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Responses])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange', '10', 'BRL', 'USD', '5']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"valorConvertido":50,"simboloMoeda":"$"}');
    }
}
