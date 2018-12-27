<?php
namespace PersonareExchange\Test\Unit\Domain\Services;

use PersonareExchange\Domain\Entities\Currency;
use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;
use PersonareExchange\Domain\Services\ExchangeService;
use PersonareExchange\Domain\Services\Responses;
use PHPUnit\Framework\TestCase;
use PersonareExchange\Application\DTO\CurrencyDTO;


class ExchangeTestCase extends TestCase
{
  protected $currencyRepository;

  protected function setUp()
  {
    $this->currencyRepository = $this->createMock(CurrencyRepository::class);
    $this->exchange = new ExchangeService($this->currencyRepository);
  }

  public function testReturnTypeOfConvertion()
  {
    $this->assertInstanceOf(Currency::class, $this->exchange->convert('USD', 'BRL', 40.5));
  }

  public function testReturnedValue()
  {
    $converted = $this->exchange->convert('EUR', 'BRL', 20);
    $this->assertEquals(89.000, $converted->getValue());
  }

  /**
   * @expectedException TypeError
   */
  public function testFindQuoteFromCodeErrorWithoutArgument()
  {
    $this->exchange->convert('USD', 'BRL', '');
  }
}


