<?php

namespace App\Core\Entities;

interface ICurrency {
    public function getName();
    public function getId();
    public function getSymbol();
}