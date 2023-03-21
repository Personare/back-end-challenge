<?php

declare(strict_types=1);

namespace Tests\Service\Currency\Convert;

use App\Domain\Currency\Entities\Currency;
use App\Domain\Currency\Enums\CurrencyEnum;
use PHPUnit\Framework\TestCase;
use App\Domain\Currency\ValueObjects\CurrencyValueObject;
use App\Service\Currency\Convert\CurrencyConverterService;

class CurrencyConverterServiceTest extends TestCase
{
    /**
     * @covers
     */
    public function testConvertCurrencyFromRealToDollar(): void
    {
        $sourceCurrency = Currency::create(CurrencyEnum::BRL);
        $targetCurrency = Currency::create(CurrencyEnum::USD);
        $exchangeRate = 0.18;
        $amount = 100.0;

        $currencyConverter = new CurrencyConverterService();
        $result = $currencyConverter->convert($amount, $sourceCurrency, $targetCurrency, $exchangeRate);

        $this->assertInstanceOf(CurrencyValueObject::class, $result);
        $this->assertEquals(18.0, $result->getValue());
        $this->assertEquals('US$', $result->getCurrency()->getSymbol());
    }

    /**
     * @covers
     */
    public function testConvertCurrencyFromDollarToReal(): void
    {
        $sourceCurrency = Currency::create(CurrencyEnum::USD);
        $targetCurrency = Currency::create(CurrencyEnum::BRL);
        $exchangeRate = 5.60;
        $amount = 100.0;

        $currencyConverter = new CurrencyConverterService();
        $result = $currencyConverter->convert($amount, $sourceCurrency, $targetCurrency, $exchangeRate);

        $this->assertInstanceOf(CurrencyValueObject::class, $result);
        $this->assertEquals(560.0, $result->getValue());
        $this->assertEquals('R$', $result->getCurrency()->getSymbol());
    }

    /**
     * @covers
     */
    public function testConvertCurrencyFromRealToEuro(): void
    {
        $sourceCurrency = Currency::create(CurrencyEnum::BRL);
        $targetCurrency = Currency::create(CurrencyEnum::EUR);
        $exchangeRate = 0.17800008;
        $amount = 100.0;

        $currencyConverter = new CurrencyConverterService();
        $result = $currencyConverter->convert($amount, $sourceCurrency, $targetCurrency, $exchangeRate);

        $this->assertInstanceOf(CurrencyValueObject::class, $result);
        $this->assertEquals(17.8, round($result->getValue(), 2));
        $this->assertEquals('€', $result->getCurrency()->getSymbol());
    }

    /**
     * @covers
     */
    public function testConvertCurrencyFromEuroToReal(): void
    {
        $sourceCurrency = Currency::create(CurrencyEnum::EUR);
        $targetCurrency = Currency::create(CurrencyEnum::BRL);
        $exchangeRate = 5.6186666;
        $amount = 100.0;

        $currencyConverter = new CurrencyConverterService();
        $result = $currencyConverter->convert($amount, $sourceCurrency, $targetCurrency, $exchangeRate);

        $this->assertInstanceOf(CurrencyValueObject::class, $result);
        $this->assertEquals(561.87, round($result->getValue(), 2));
        $this->assertEquals('R$', $result->getCurrency()->getSymbol());
    }

}
