<?php

namespace App\Core\Repository;

interface IRepository{
    public function findById(string $id);
}