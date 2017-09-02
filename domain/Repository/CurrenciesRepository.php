<?php

namespace Domain\Repository;

class CurrenciesRepository
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * CurrenciesRepository constructor.
     * @param \PDO $PDO
     */
    public function __construct(\PDO $PDO)
    {
        $this->pdo = $PDO;
    }

    /**
     * @param $iso
     * @return array
     */
    public function getByIso($iso): array
    {
        $sth = $this->pdo->prepare('SELECT * FROM currencies WHERE iso = ?');
        $sth->execute([$iso]);

        return $sth->fetch();
    }
}