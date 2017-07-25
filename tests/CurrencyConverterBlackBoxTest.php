<?php

use PHPUnit\Framework\TestCase;

class CurrencyConverterBlackBoxTest extends TestCase
{
    public function testRetursCorrectValuesWhenNoErrors(){
        $cc = new CurrencyConverter('usd', 'brl', 2, 3);
        $returned_value = $cc->build();

        $this->assertArrayHasKey('value', $returned_value);
        $this->assertArrayHasKey('symbol', $returned_value);
        $this->assertEquals(6, $returned_value['value']);
        $this->assertEquals(200, $cc->status());
    }

    public function testRetursStatusErrorAndHashOnClassMisuse(){
        $cc = new CurrencyConverter(null, 'brl', null, null);
        $returned_value = $cc->build();

        $this->assertEquals(400, $cc->status());
        $this->assertArrayHasKey('errors', $returned_value);
    }
}
?>
