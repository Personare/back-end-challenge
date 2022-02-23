<?php

namespace App\Core\Entities;

class Real implements ICurrency{

    public function getId(){
        return "BRL";
    }

    public function getSymbol(){
        return "R$";
    }
}