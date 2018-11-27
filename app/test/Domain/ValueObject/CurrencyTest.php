<?php


namespace MoneyConverter\Tests\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use MoneyConverter\Domain\ValueObject\Currency;


class CurrencyTest extends TestCase {

	const BRL_CODE = 'BRL';
	const INVALID_CODE = 'QWERTY_';

	/**
	 * @test
	 */
	public function testAssertPreConditions() {
        $this->assertTrue(
            class_exists($class = 'MoneyConverter\Domain\ValueObject\Currency'),
            'Class not found: ' . $class
        );
    }

	/**
    * @expectedException InvalidArgumentException
    */
    public function testInvalidCodeExpectException() {
        $currency = new Currency(self::INVALID_CODE);
    }

	/**
    * @test
    */
    public function testCreateBrlCurrency() {
        $currency = new Currency(self::BRL_CODE);

        $this->assertEquals(new Currency(self::BRL_CODE), $currency);
    }
}


?>