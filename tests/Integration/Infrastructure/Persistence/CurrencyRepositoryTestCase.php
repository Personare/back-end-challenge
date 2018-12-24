<?php
namespace PersonareExchange\Test\Integration\Infrastructure\Persistence;

use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;
use PHPUnit\Framework\TestCase;

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
    $this->assertEquals(3, $rate);
  }

}