<?php

namespace App\Application\Controllers;

use App\Core\UseCase\ExchangeUseCaseDTO;
use App\Core\UseCase\IUseCase;

class ExchangeController
{
    private IUseCase $useCase;

    public function __construct(IUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function handle(array $params)
    {
        return $this->useCase->execute(new ExchangeUseCaseDTO($params));   
    }
}
