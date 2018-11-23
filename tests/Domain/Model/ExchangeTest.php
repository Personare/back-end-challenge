<?php

namespace Personare\Exchange\Test\Domain\Model;

use PHPUnit\Framework\TestCase;
use Personare\Exchange\Domain\Repository\CurrencyRepositoryInterface;
use Personare\Exchange\Domain\Model\Exchange;
use Personare\Exchange\Domain\Model\Currency;

class ExchangeTest extends TestCase
{
    protected $currencyRepository;

    protected function setUp()
    {
        $this->currencyRepository = $this->createMock(CurrencyRepositoryInterface::class);

        $this->currencyRepository->method('findFromCode')
            ->will($this->returnCallback(function ($code) {
                $currency = new Currency();
                if ($code === 'BRL') {
                    $currency->setCode('BRL');
                    $currency->setSymbol('R$');
                    $currency->setValue('1.000');
                    $currency->setBase(true);
                } else {
                    $currency->setCode('USD');
                    $currency->setSymbol('$');
                    $currency->setValue('3.800');
                    $currency->setBase(false);
                }
                return $currency;
            }));
    }

    public function testConvert1UsdToBrlShouldBe3Dot8()
    {
        $from = $this->currencyRepository->findFromCode('USD');
        $to = $this->currencyRepository->findFromCode('BRL');

        $exchange = new Exchange($from, $to, 1);
        $value = $exchange->convert();

        $this->assertEquals(3.8, $value);
    }

    public function testConvert114BrlToUsdShouldBe30()
    {
        $from = $this->currencyRepository->findFromCode('BRL');
        $to = $this->currencyRepository->findFromCode('USD');

        $exchange = new Exchange($from, $to, 114);
        $value = $exchange->convert();

        $this->assertEquals(30, $value);
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testNegativeParamValue()
    {
        $from = $this->currencyRepository->findFromCode('BRL');
        $to = $this->currencyRepository->findFromCode('USD');

        new Exchange($from, $to, -1000);

    }
}