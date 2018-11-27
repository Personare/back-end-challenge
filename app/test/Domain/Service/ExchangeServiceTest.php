<?php


namespace MoneyConverter\Tests\Domain\Service;

use PHPUnit\Framework\TestCase;
use MoneyConverter\Domain\Repository\ExchangeRepositoryInterface;
use MoneyConverter\Domain\Service\ExchangeService;
use MoneyConverter\Domain\ValueObject\Currency;
use MoneyConverter\Domain\ValueObject\Money;


class ExchangeServiceTest extends TestCase {
	private $exchangeRepository;

	public function setUp() {
		$this->exchangeRepository = $this->createMock(ExchangeRepositoryInterface::class);
		$this->exchangeRepository->method('getQuote')
			->will($this->returnCallback(function ($from, $to) {
				if ($from->code() == 'BRL' ){
					if ($to->code() == 'USD') {
						$money = new Money(0.256, $from);
					} else if ($to->code() == 'EUR') {
						$money = new Money(0.178, $from);
					} else {
						$money = new Money(1, $from);
					}
				} else if ($from->code() == 'USD') {
					$money = new Money(3.9, $from);
				} else if ($from->code() == 'EUR') {
					$money = new Money(4.46, $from);
				}
				return $money;
			}));
	}

	/**
	 * @test
	 */
	public function testAssertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'MoneyConverter\Domain\Entity\Exchange'),
            'Class not found: ' . $class
        );
    }

	/**
	 * @test
	 */
	public function testConvert1UsdToBrlEquals390() {
		$fromCurrency = new Currency('USD');
		$toCurrency = new Currency('BRL');

		$exchange = new ExchangeService($this->exchangeRepository);
		$convertedMoney = $exchange->convert($fromCurrency, $toCurrency, 1);

		$this->assertEquals(3.9, $convertedMoney->amount());
	}

	/**
	 * @test
	 */
	public function testConvert1EurToBrlEquals446() {
		$fromCurrency = new Currency('EUR');
		$toCurrency = new Currency('BRL');

		$exchange = new ExchangeService($this->exchangeRepository);
		$convertedMoney = $exchange->convert($fromCurrency, $toCurrency, 1);

		$this->assertEquals(4.46, $convertedMoney->amount());
	}

	/**
	 * @test
	 */
	public function testConvert10BrlToUsdEquals2560() {
		$fromCurrency = new Currency('BRL');
		$toCurrency = new Currency('USD');

		$exchange = new ExchangeService($this->exchangeRepository);
		$convertedMoney = $exchange->convert($fromCurrency, $toCurrency, 10);

		$this->assertEquals(2.560, $convertedMoney->amount());
	}

	/**
	 * @test
	 */
	public function testConvert8BrlToEurEquals1424() {
		$fromCurrency = new Currency('BRL');
		$toCurrency = new Currency('EUR');

		$exchange = new ExchangeService($this->exchangeRepository);
		$convertedMoney = $exchange->convert($fromCurrency, $toCurrency, 8);

		$this->assertEquals(1.424, $convertedMoney->amount());
	}
}

?>