<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once('TestCase.php');
require_once('src/ResponseHandler.php');

class ResponseHandlerTest extends TestCase
{
    protected $response_handler;

    public function setUp()
    {
        $this->response_handler = new ResponseHandler();
    }

    public function testBuildResponseShouldSetResponse(): void
    {
        $conversion = array('original_value' => '$ 3.45', 'converted_value' => 'R$ 6.90');

        $this->response_handler->buildResponse($conversion, 200);

        $response = $this->getPropertyValue($this->response_handler, 'response');

        $this->assertEquals($conversion, $response);
    }

    public function testBuildResponseShouldSetStatusCode(): void
    {
        $conversion = array('original_value' => '$ 3.45', 'converted_value' => 'R$ 6.90');
        $given_status_code = 200;

        $this->response_handler->buildResponse($conversion, $given_status_code);

        $status_code = $this->getPropertyValue($this->response_handler, 'status_code');

        $this->assertEquals($given_status_code, $status_code);
    }

    public function testBuildExceptionShouldCallBuildResponse(): void
    {
        $message = 'No rate available for the given currencies.';

        $mock = $this->getMockBuilder(ResponseHandler::class)
                     ->setMethods(array('buildResponse'))
                     ->getMock();

        $mock->expects($this->once())
             ->method('buildResponse')
             ->with(array('error' => $message));

        $mock->buildException($message, 400);
    }
}
