<?php


namespace MoneyConverter\Tests\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use MoneyConverter\Domain\ValueObject\Money;
use MoneyConverter\Domain\ValueObject\Currency;

class MoneyTest extends TestCase {
	const AMOUNT = 10.10;
	const NEGATIVE_AMOUNT = -5;

	/**
	 * @test
	 */
	public function testAssertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'MoneyConverter\Domain\ValueObject\Money'),
            'Class not found: ' . $class
        );
    }

	/**
	 * @test
	 */
	public function testItCurrencyNotEqualsToAnotherMoney() {
		$money = new Money(self::AMOUNT, new Currency('BRL', 'R$'));
		$this->assertEquals(false, $money->currency()->equals(new Currency('USD', '$'))); 
	}

	/**
	 * @test
	 */
	public function testItCurrencyEqualsToAnotherMoney() {
		$money = new Money(self::AMOUNT, new Currency('USD', '$'));
		$this->assertEquals(true, $money->currency()->equals(new Currency('USD', '$'))); 
	}

	/**
    * @expectedException InvalidArgumentException
    */
    public function testNegativeAmountExpectException()
    {
        $money = new Money(self::NEGATIVE_AMOUNT, new Currency('BRL', 'R$'));
     }
}


?>