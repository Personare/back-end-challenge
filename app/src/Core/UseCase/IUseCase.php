<?php
namespace App\Core\UseCase;

use App\Core\Entities\ICurrency;

interface IUseCase{
    public function execute(ICurrency $from, ICurrency $to, float $value,float $cotation);
}