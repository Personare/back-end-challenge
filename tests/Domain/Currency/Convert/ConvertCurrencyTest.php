<?php

declare(strict_types=1);

namespace Tests\Domain\Currency\Convert;
use App\Domain\Currency\Enums\CurrencyEnum;
use PHPUnit\Framework\TestCase;


use App\Domain\Currency\Convert\ConvertCurrency;

class ConvertCurrencyTest extends TestCase
{
    /**
     * @covers
     */
    public function testConvertRealToDollar()
    {
        $convert = new ConvertCurrency(
            CurrencyEnum::BRL,
            CurrencyEnum::USD,
            5.28
        );
        $result = $convert->convert(10.0);

        $this->assertEquals(1.89, $result->getValue());
        $this->assertEquals('US$ 1,89', $result->__toString());
    }

    
}
