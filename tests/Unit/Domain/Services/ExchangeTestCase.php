<?php
namespace PersonareExchange\Test\Unit\Domain\Services;

use PersonareExchange\Domain\Entities\Currency;
use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;
use PersonareExchange\Domain\Services\ExchangeService;
use PersonareExchange\Domain\Services\Responses;
use PHPUnit\Framework\TestCase;


class ExchangeTestCase extends TestCase
{
  protected $currencyRepository;

  protected function setUp()
  {
    $this->currencyRepository = $this->createMock(CurrencyRepository::class);
    $this->exchange = new ExchangeService($this->currencyRepository);
  }

  /**
   * @test
   */
  public function testAssertClassExist()
  {
    $this->assertTrue(
      class_exists($class = 'PersonareExchange\Domain\Entities\Currency'),
      'Class not found: ' . $class
    );
  }

  public function testAssertClassCorrectType()
  {
    $this->assertInstanceOf(Currency::class, new Currency);
  }

  public function testConvertion()
  {
    $this->assertInstanceOf(Currency::class, $this->exchange->convert('USD', 'BRL', 40.5));
  }
}


