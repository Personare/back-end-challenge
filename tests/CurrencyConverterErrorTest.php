
<?php

use PHPUnit\Framework\TestCase;

class CurrencyConverterErrorTest extends TestCase
{
    protected $retured_value;
    protected $status;

    public function testErrorStatusReturned(){
        $cc = new CurrencyConverter(null, null, null, null);
        $retured_value = $cc->build();
        $status = $cc->status();
        $this->assertEquals(400, $status);
    }

    public function testErrorBRLNotPresent(){
        $cc = new CurrencyConverter('usd', 'eur', 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals(400, $cc->status());
    }

    public function testErrorCurrencyToNotSet(){
        $cc = new CurrencyConverter(null, 'brl', 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals(400, $cc->status());
    }

    public function testErrorCurrencyFromNotSet(){
        $cc = new CurrencyConverter('brl', null, 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals(400, $cc->status());
    }

    public function testErrorSameCurrency(){
        $cc = new CurrencyConverter('brl', 'brl', 1, 2);
        $retured_value = $cc->build();

        $this->assertEquals(400, $cc->status());
    }
}
?>
