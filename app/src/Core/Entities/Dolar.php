<?php

namespace App\Core\Entities;

class Dolar implements ICurrency{

    public function getId(){
        return "USD";
    }

    public function getSymbol(){
        return "$";
    }
}