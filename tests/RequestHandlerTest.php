<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once('TestCase.php');
require_once('src/RequestHandler.php');

class RequestHandlerTest extends TestCase
{
    public function testConstructShouldSetParams(): void
    {
        $params = array('from' => 'USD', 'to' => 'BRL', 'value' => '3.45');

        $request_handler = new RequestHandler($params);

        $this->assertEquals($params, $this->getPropertyValue($request_handler, 'params'));
    }

    public function testConstructShouldSetRequiredKeys(): void
    {
        $params = array('from' => 'USD', 'to' => 'BRL', 'value' => '3.45');
        $required_keys = ['from', 'to', 'value'];

        $request_handler = new RequestHandler($params);

        $this->assertEquals($required_keys, $this->getPropertyValue($request_handler, 'required_keys'));
    }

    public function testSanitizedParamsShouldReturnAnArray(): void
    {
        $request_handler = new RequestHandler(
            array('from' => 'USD', 'to' => 'BRL', 'value' => '3.45')
        );

        $this->assertInternalType('array', $request_handler->sanitizedParams());
    }

    public function testSanitizedParamsShouldReturnFromInLowercase(): void
    {
        $request_handler = new RequestHandler(
            array('from' => 'usd', 'to' => 'BRL', 'value' => '3.45')
        );

        $this->assertEquals('USD', $request_handler->sanitizedParams()['from']);
    }

    public function testSanitizedParamsShouldReturnToInLowercase(): void
    {
        $request_handler = new RequestHandler(
            array('from' => 'USD', 'to' => 'brl', 'value' => '3.45')
        );

        $this->assertEquals('BRL', $request_handler->sanitizedParams()['to']);
    }

    public function testSanitizedParamsShouldReturnValueAsAFloat(): void
    {
        $request_handler = new RequestHandler(
            array('from' => 'USD', 'to' => 'BRL', 'value' => '3.45')
        );

        $this->assertEquals(3.45, $request_handler->sanitizedParams()['value']);
    }

    public function testCheckValidParamsShouldRaiseExceptionIfMissingFrom(): void
    {
        $request_handler = new RequestHandler(
            array('to' => 'BRL', 'value' => '3.45')
        );

        $this->expectException(InvalidParametersException::class);

        $this->invokeMethod($request_handler, 'checkValidParams');
    }

    public function testCheckValidParamsShouldRaiseExceptionIfMissingTo(): void
    {
        $request_handler = new RequestHandler(
            array('from' => 'USD', 'value' => '3.45')
        );

        $this->expectException(InvalidParametersException::class);

        $this->invokeMethod($request_handler, 'checkValidParams');
    }

    public function testCheckValidParamsShouldRaiseExceptionIfMissingValue(): void
    {
        $request_handler = new RequestHandler(
            array('from' => 'USD', 'to' => 'BRL')
        );

        $this->expectException(InvalidParametersException::class);

        $this->invokeMethod($request_handler, 'checkValidParams');
    }
}
