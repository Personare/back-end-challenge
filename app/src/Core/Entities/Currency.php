<?php

namespace App\Core\Entities;

class Currency implements ICurrency
{

    private string $name;
    private string $id;
    private string $symbol;

    public function __construct(string $name, string $id, string $symbol)
    {
        $this->name = $name;
        $this->id = $id;
        $this->symbol = $symbol;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
