<?php
namespace PersonareExchange\Test\Unit\Domain\Services;

use PersonareExchange\Domain\Entities\Currency;
use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;
use PersonareExchange\Domain\Services\ExchangeService;
use PHPUnit\Framework\TestCase;


class ExchangeTestCase extends TestCase
{
  protected $currencyRepository;

  protected function setUp()
  {
    $this->currencyRepository = $this->getMockBuilder(CurrencyRepository::class)
                                      ->getMock();
    $this->exchange = new ExchangeService($this->currencyRepository);
  }

  public function testReturnCorrectTypeOfConvertion()
  {
    $this->assertInstanceOf(Currency::class, $this->exchange->convert('USD', 'BRL', 40.5));
  }

  public function testCorrectReturnedValueOfConvertion20EurToBrl()
  {
    $currencyRepository = $this->createMock(CurrencyRepository::class);
    $exchange = new ExchangeService($currencyRepository);
    $this->assertEquals(89.000, $exchange->convert('EUR', 'BRL', 20)->getValue());
  }

  /**
   * @expectedException Exception
   */
  public function testFindQuoteFromCodeErrorWithoutArgument()
  {
    $this->exchange->convert('USD', 'BRL', '');
  }
}


