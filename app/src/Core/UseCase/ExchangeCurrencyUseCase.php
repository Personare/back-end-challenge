<?php

namespace App\Core\UseCase;

use App\Core\Repository\IRepository;
use App\Core\UseCase\IRequest;

class ExchangeCurrencyUseCase implements IUseCase
{
    private IRepository $repo;


    public function __construct(IRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execute(IRequest $dto)
    {
        $to = $this->repo->findById($dto->getTo());

        $res = [
            "symbol" => $to->getSymbol(),
            "value" =>  $this->exchange($dto->getValue(),$dto->getCotation())
        ];

        return json_encode($res);
    }

    public function exchange(float $value, float $cotation){
        return round( ($value * $cotation) , 2 );
    }
}
