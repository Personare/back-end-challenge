<?php declare(strict_types = 1);

namespace App\Test\Util;

use App\Util\Responses;

final class ResponsesTest extends \PHPUnit\Framework\TestCase
{
    /** @runInSeparateProcess */
    public function testResponseJson(): void
    {
        ( new Responses )->responseJSON(
            [
                'string' => 'string',
                'number' => 1,
                'boolean' => true,
            ],
            200,
        );

        $this->expectOutputString('{"string":"string","number":1,"boolean":true}');
    }
}
