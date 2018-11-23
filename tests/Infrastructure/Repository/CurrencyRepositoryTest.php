<?php

namespace Personare\Exchange\Test\Infrastructure\Repository;

use PHPUnit\Framework\TestCase;
use Personare\Exchange\Domain\Model\Currency;
use Personare\Exchange\Infrastructure\Repository\CurrencyRepository;

class CurrencyRepositoryTest extends TestCase
{
    protected $db;

    protected function setUp()
    {
        $this->db = createDatabase();
    }

    public function testFindFromUSDCodeShouldBeReturnDollarCurrencyEntity()
    {
        $currencyRepository = new CurrencyRepository($this->db);

        $currency = $currencyRepository->findFromCode('USD');

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertEquals($currency->getValue(), 3.80);
        $this->assertEquals($currency->getBase(), 0);
        $this->assertEquals($currency->getSymbol(), "$");
    }

    public function testFindFromBRLCodeShouldBeReturnRealCurrencyEntity()
    {
        $currencyRepository = new CurrencyRepository($this->db);

        $currency = $currencyRepository->findFromCode('BRL');

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertEquals($currency->getValue(), 1.00);
        $this->assertEquals($currency->getBase(), 1);
        $this->assertEquals($currency->getSymbol(), "R$");
    }

    public function testFindFromEURCodeShouldBeReturnEuroCurrencyEntity()
    {
        $currencyRepository = new CurrencyRepository($this->db);

        $currency = $currencyRepository->findFromCode('EUR');

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertEquals($currency->getValue(), 4.34);
        $this->assertEquals($currency->getBase(), 0);
        $this->assertEquals($currency->getSymbol(), "€");
    }

    public function testFindFromUnknownCodeShouldBeNull()
    {
        $currencyRepository = new CurrencyRepository($this->db);

        $currency = $currencyRepository->findFromCode('NOT_FOUND');

        $this->assertNull($currency);
    }
}