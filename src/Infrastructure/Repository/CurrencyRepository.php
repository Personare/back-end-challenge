<?php

namespace Personare\Exchange\Infrastructure\Repository;

use Personare\Exchange\Domain\Repository\CurrencyRepositoryInterface;
use Personare\Exchange\Domain\Model\Currency;
use PDO;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function findFromCode($code) : ?Currency
    {
        $statement = $this->db->prepare("SELECT code, symbol, value, base FROM currency WHERE code = :code");

        $statement->setFetchMode(PDO::FETCH_CLASS, Currency::class);
        $statement->execute([":code" => $code]);

        $result = $statement->fetch();
        $statement->closeCursor();

        return $result ?: null;
    }
}
