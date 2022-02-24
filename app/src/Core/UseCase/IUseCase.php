<?php
namespace App\Core\UseCase;

use App\Core\UseCase\IRequest;

interface IUseCase{
    public function execute(IRequest $dto);
}