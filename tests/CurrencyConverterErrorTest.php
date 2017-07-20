
<?php

use PHPUnit\Framework\TestCase;

class CurrencyValidatorTest extends TestCase
{
    protected $retured_value;
    protected $status;

    public function testErrorBRLNotPresent(){
        $cv = new CurrencyValidator('usd', 'eur', 1, 2);

        $this->assertFalse($cv->isValid());
    }

    public function testErrorCurrencyToNotSet(){
        $cv = new CurrencyValidator(null, 'brl', 1, 2);

        $this->assertFalse($cv->isValid());
    }

    public function testErrorCurrencyFromNotSet(){
        $cv = new CurrencyValidator('brl', null, 1, 2);

        $this->assertFalse($cv->isValid());
    }

    public function testErrorSameCurrency(){
        $cv = new CurrencyValidator('brl', 'brl', 1, 2);

        $this->assertFalse($cv->isValid());
    }
}
?>
