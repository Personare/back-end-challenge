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

        $this->assertEquals('{"symbol":"R$","value":5.29}', $exchange->execute($dto));
    }

    public function testExchangeTwoUSDToBrl()
    {
        $this->params['value'] = 2;

        $dto = new ExchangeUseCaseDTO($this->params);
        $exchange = new ExchangeCurrencyUseCase($this->repository);

        $this->assertEquals('{"symbol":"R$","value":10.58}', $exchange->execute($dto));
    }

    public function testInvalidValueException()
    {
        $this->params['value'] = "joao";

        $this->expectError();
        $this->expectException(InvalidArgumentException::class);

        $dto = new ExchangeUseCaseDTO($this->params);
        $exchange = new ExchangeCurrencyUseCase($this->repository);
        $res = json_decode($exchange->execute($dto), true);

        $this->expectExceptionMessageMatches("inform numeric value with .",$res['Error']);

    }

    public function testInvalidCotationException()
    {
        $this->params['cotation'] = "joao";

        $this->expectError();
        $this->expectException(InvalidArgumentException::class);

        $dto = new ExchangeUseCaseDTO($this->params);
        $exchange = new ExchangeCurrencyUseCase($this->repository);
        $res = json_decode($exchange->execute($dto), true);
        
        $this->expectExceptionMessageMatches("inform numeric value with .",$res['Error']);

    }
}
