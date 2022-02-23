<?php

namespace App;

use App\Core\Entities\Dolar;
use App\Core\Entities\Real;
use App\Core\UseCase\ExchangeCurrencyUseCase;
use PHPUnit\Framework\TestCase;

class ExchangeCurrencyTest extends TestCase
{

    protected function setUp(): void
    {
        // configuração 
    }

    public function testExchangeOneUseToBrl()
    {
        $from = new Dolar();
        $to = new Real();
        $value = 1;
        $cotation = 5.29;

        $exchange = new ExchangeCurrencyUseCase();

        $this->assertEquals('{"symbol":"R$","value":5.29}', $exchange->execute($from, $to, $value, $cotation));
    }
}
