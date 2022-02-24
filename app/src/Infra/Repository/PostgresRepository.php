<?php

namespace App\Infra\Repository;

use App\Core\Entities\Currency;
use App\Core\Repository\IRepository;

class PostgresRepository implements IRepository
{
    
    private \PDO $pdo;

    public function __construct()
    {
        $db = getenv('POSTGRES_DB');
        $user = getenv('POSTGRES_USER');
        $password = getenv('POSTGRES_PASSWORD');
        $dsn = "pgsql:host=postgres;port=5432;dbname=$db;";
        $this->pdo = new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    

    public function findById(string $id)
    {
        $data = $this->pdo->query("SELECT * FROM currency WHERE currency_id ='$id' ")->fetch(\PDO::FETCH_OBJ);

        if (empty($data)) {
            throw new \Exception("Id not found", 404);
        }

        return new Currency($data->name, $data->currency_id, $data->symbol);
    }

}
