<?php

namespace Personare\Exchange\DataAccess;

use PDO;
use PHPUnit\Framework\TestCase;

class CurrencyDAOTest extends TestCase
{
    protected $pdo;

    protected function setUp()
    {
        $this->pdo = new PDO("sqlite::memory:");
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS currency (
                code VARCHAR(3) PRIMARY KEY,
                symbol VARCHAR(10) NOT NULL,
                value DECIMAL NOT NULL,
                base INTEGER NOT NULL DEFAULT 0
            );
            
            INSERT INTO currency 
                (code, symbol, value, base) 
            VALUES 
                ('USD', '$', 4.00, 0),
                ('BRL', 'R$', 1.00, 1);
        ");
    }

    public function testAssertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Personare\Exchange\DataAccess\CurrencyDAO'),
            'Class not found: ' . $class
        );
    }

    public function testLoadFromUSDCodeShouldReturnDollarCurrencyEntity()
    {
        $currencyDao = new CurrencyDAO($this->pdo);

        $currency = $currencyDao->loadFromCode('USD');

        $this->assertInstanceOf("Personare\Exchange\DataAccess\Entity\Currency", $currency);
        $this->assertEquals($currency->getValue(), 4);
        $this->assertEquals($currency->getBase(), false);
    }

    public function testLoadFromBRLCodeShouldReturnRealCurrencyEntity()
    {
        $currencyDao = new CurrencyDAO($this->pdo);

        $currency = $currencyDao->loadFromCode('BRL');

        $this->assertInstanceOf("Personare\Exchange\DataAccess\Entity\Currency", $currency);
        $this->assertEquals($currency->getValue(), 1);
        $this->assertEquals($currency->getBase(), true);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testLoadFromUnknowCodeShouldThrowAnException()
    {
        $currencyDao = new CurrencyDAO($this->pdo);

        $currencyDao->loadFromCode('BATATA');
    }
}
