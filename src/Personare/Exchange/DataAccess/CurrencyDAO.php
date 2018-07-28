<?php

namespace Personare\Exchange\DataAccess;

use \PDO;
use \RuntimeException;

class CurrencyDAO
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function loadFromCode($code)
    {
        $stm = $this->pdo->prepare("SELECT code, symbol, value, base FROM currency WHERE code = :code");

        $stm->setFetchMode(PDO::FETCH_CLASS, "Personare\Exchange\DataAccess\Entity\Currency");
        $stm->bindValue(":code", $code, PDO::PARAM_STR);

        if ($stm->execute()) {
            if ($currency = $stm->fetch()) {
                $stm->closeCursor();
                return $currency;

            }
        }

        throw new RuntimeException("Code cannot return any currency");
    }
}
