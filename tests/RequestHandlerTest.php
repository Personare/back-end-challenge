<?php

declare(strict_types=1);

namespace CurrencyConverter;

require_once('TestCase.php');
require_once('src/RequestHandler.php');

class RequestHandlerTest extends TestCase
{
    protected $request_handler;

    public function testSanitizedParamsShouldReturnAnArray(): void
    {
        $request_handler = new RequestHandler(
            array('from' => 'USD', 'to' => 'BRL', 'value' => '3.45')
        );

        $this->assertInternalType('array', $request_handler->sanitizedParams());
    }
}
