<?php

namespace App\Core\UseCase;


interface IRequest
{
    public function validate(array $params):void;
    public function getFrom(): string;
    public function getTo(): string;
    public function getValue(): float;
    public function getCotation(): float;
}
