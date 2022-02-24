<?php

namespace App;

use App\Core\Entities\Currency;
use App\Core\UseCase\ExchangeCurrencyUseCase;
use App\Core\UseCase\ExchangeUseCaseDTO;
use App\Infra\Repository\PostgresRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ExchangeCurrencyTest extends TestCase
{

    protected function setUp(): void
    {
        $this->params = [
            "from" => "USD",
            "to" => "BRL",
            "value" => 1,
            "cotation" => 5.29
        ];

        $this->real = new Currency("Real", "BRL", "R$");


        $this->repository = $this->getMockBuilder(PostgresRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $this->repository->expects($this->any())
            ->method('findById')
            ->with($this->equalTo($this->params['to']))
            ->will($this->returnValue($this->real));
    }

    public function testExchangeOneUSDToBrl()
    {
        $dto = new ExchangeUseCaseDTO($this->params);
        $exchange = new ExchangeCurrencyUseCase($this->repository);

        $res = json_decode($exchange->execute($dto), true);

        $this->assertEquals('{"symbol":"R$","value":5.29}', $exchange->execute($dto));
        $this->assertJsonStringEqualsJsonString('{"symbol":"R$","value":5.29}', $exchange->execute($dto));
        $this->assertEquals($this->real->getSymbol(), $res['symbol']);
        $this->assertEquals(5.29, $res['value']);
        $this->assertIsNumeric($res['value']);
    }

    public function testExchangeTwoUSDToBrl()
    {
        $this->params['value'] = 2;

        $dto = new ExchangeUseCaseDTO($this->params);
        $exchange = new ExchangeCurrencyUseCase($this->repository);
        $res = json_decode($exchange->execute($dto), true);

        $this->assertEquals('{"symbol":"R$","value":10.58}', $exchange->execute($dto));
        $this->assertJsonStringEqualsJsonString('{"symbol":"R$","value":10.58}', $exchange->execute($dto));
        $this->assertEquals($this->real->getSymbol(), $res['symbol']);
        $this->assertEquals(10.58, $res['value']);
        $this->assertIsNumeric($res['value']);
    }

    public function testInvalidValueException()
    {
        $this->params['value'] = "joao";

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("inform numeric value with .");
        $dto = new ExchangeUseCaseDTO($this->params);
    }

    public function testInvalidCotationException()
    {
        $this->params['cotation'] = "joao";

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("inform numeric cotation with .");

        $dto = new ExchangeUseCaseDTO($this->params);
    }

    public function testEmptyFieldsException()
    {
        $params = [
            "from",
            "to",
            "value",
            "cotation"
        ];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("inform from,inform to,inform numeric value with .,inform numeric cotation with .");

        $dto = new ExchangeUseCaseDTO($params);
      
    }
}
