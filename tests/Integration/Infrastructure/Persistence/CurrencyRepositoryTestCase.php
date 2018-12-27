<?php
namespace PersonareExchange\Test\Integration\Infrastructure\Persistence;

use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;
use PHPUnit\Framework\TestCase;
use PersonareExchange\Application\DTO\CurrencyDTO;

class CurrencyRepositoryTest extends TestCase
{
  private $repository;
  public function setUp()
  {
    parent::setUp();
    $this->repository = new CurrencyRepository();

  }

  public function testFindQuoteFromCode()
  {
    $rate = $this->repository->findQuoteFromCode('USD', 'EUR');
    $this->assertInstanceOf(CurrencyDTO::class, $rate);
  }
  
  public function testFindQuoteFromCodeValue()
  {
    $rate = $this->repository->findQuoteFromCode('USD', 'EUR');
    $this->assertEquals(0.870, $rate->getValue());
  }
  
  /**
   * @expectedException ArgumentCountError
   */
  public function testFindQuoteFromCodeErrorWithoutArgument()
  {
    $this->repository->findQuoteFromCode();
  }

}