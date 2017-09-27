<?php

use PHPUnit\Framework\TestCase;


/**
 * @covers Helper
 */
class HelperTest extends TestCase
{
    public function testValidArrayKeysExists()
    {
        $array = array(
            'foo' => 1,
            'bar' => 2
        );

        $array_keys = array('foo', 'bar');

        $this->assertTrue(Helper::array_keys_exists($array, $array_keys));
    }

    public function testInvalidArrayKeysExists()
    {
        $array = array(
            'foo' => 1,
            'bar' => 2
        );

        $array_keys = array('foo', 'key');

        $this->assertFalse(Helper::array_keys_exists($array, $array_keys));
    }

    public function testValueConverterOk()
    {
        $this->assertEquals(Helper::currency_converter('10.00', '3.1931'), '3.13');
    }
}