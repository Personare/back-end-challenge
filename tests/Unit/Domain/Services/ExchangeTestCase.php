<?php
namespace PersonareExchange\Test\Unit\Domain\Services;

use PersonareExchange\Domain\Entities\Currency;
use PersonareExchange\Application\DTO\CurrencyDTO;
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
    $this->currencyRepository->method('findQuoteFromCOde')
        ->will(($this->returnCallback(function ($codeFrom, $codeTo) {
          $quote = $this->currencyRepository->quoteList[$codeFrom][$codeTo];
          $currencyDTO = new CurrencyDTO($codeFrom, $quote);
          return $currencyDTO;
      })));
  }

  public function testReturnCorrectTypeOfConvertion()
  {
    $exchange = new ExchangeService($this->currencyRepository);
    $this->assertInstanceOf(Currency::class, $exchange->convert('USD', 'BRL', 40.5));
  }

  public function testCorrectReturnedValueOfConvertion20EurToBrl()
  {
    $exchange = new ExchangeService($this->currencyRepository);
    $this->assertEquals(89.00, $exchange->convert('EUR', 'BRL', 20)->getValue());
  }

  public function testCorrectReturnedValueOfConvertion2569UsdToBrl()
  {
    $exchange = new ExchangeService($this->currencyRepository);
    $this->assertEquals(99.677, $exchange->convert('USD', 'BRL', 25.69)->getValue());
  }

  /**
   * @expectedException Exception
   */
  public function testFindQuoteFromCodeErrorWithoutArgument()
  {
    $exchange = new ExchangeService($this->currencyRepository);
    $exchange->convert('USD', 'BRL', '');
  }
}


