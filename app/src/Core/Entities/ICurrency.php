<?php

namespace App\Core\Entities;

interface ICurrency {
    public function getId();
    public function getSymbol();
}