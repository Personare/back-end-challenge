<?php declare(strict_types = 1);

namespace App\Test\Controller;

use App\Controller\Exchange;
use App\Service\Exchange as Service;
use App\Service\HttpResponse\Json as Response;

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
            ->setConstructorArgs([new Service, new Response])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"M\u00e9todo dispon\u00edvel: \/exchange"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyValue(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Response])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"Informe um valor ex.: \/exchange\/10"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyFrom(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Response])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange', '10']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"Informe a moeda de origem ex.: \/exchange\/10\/BRL"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyTo(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Response])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange', '10', 'BRL']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"Informe a moeda de destino ex.: \/exchange\/10\/BRL\/USD"}');
    }

    /** @runInSeparateProcess */
    public function testEmptyRate(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Response])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->willReturn(['http://localhost:8000', 'exchange', '10', 'BRL', 'USD']);

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"Informe a taxa de convers\u00e3o ex.: \/exchange\/10\/BRL\/USD\/6.78"}');
    }

    /** @runInSeparateProcess */
    public function testForcedException(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Response])
            ->onlyMethods(['getRequestUri'])
            ->getMock();

        $exchange
            ->method('getRequestUri')
            ->will($this->throwException(new \Exception));

        // @phan-suppress-next-line PhanUndeclaredMethod
        $exchange->restApi();

        $this->expectOutputString('{"message":"A API est\u00e1 inst\u00e1vel no momento, tente mais tarde!"}');
    }

    /** @runInSeparateProcess */
    public function testSuccess(): void
    {
        /**
         * phpcs:ignore SlevomatCodingStandard.PHP.RequireExplicitAssertion
         * @var \App\Controller\Exchange&\PHPUnit\Framework\MockObject\MockObject $exchange
         * */
        $exchange = $this->getMockBuilder(Exchange::class)
            ->setConstructorArgs([new Service, new Response])
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
