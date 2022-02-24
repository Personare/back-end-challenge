<?php

namespace App\Core\Repository;

use App\Core\Entities\Currency;

interface IRepository{
    public function findById(string $id);
}