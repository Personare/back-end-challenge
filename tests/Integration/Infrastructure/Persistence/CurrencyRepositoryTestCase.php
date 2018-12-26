<?php
namespace PersonareExchange\Test\Integration\Infrastructure\Persistence;

use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;
use PHPUnit\Framework\TestCase;
use PersonareExchange\Domain\Entities\Currency;

class CurrencyRepositoryTest extends TestCase
{
  private $repository;
  public function setUp()
  {
    parent::setUp();
    $this->repository = new CurrencyRepository();

  }

  public function testFindRateFromSymbol()
  {
    $rate = $this->repository->findRateFromSymbol('USD');
    $this->assertInstanceOf(Currency::class, $rate);
  }
  
  /**
   * @expectedException ArgumentCountError
   */
  public function testFindRateFromSymbolErrorWithoutArgument()
  {
    $this->repository->findRateFromSymbol();
  }

}