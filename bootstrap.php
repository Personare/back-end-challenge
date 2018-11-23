<?php

require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

function createDatabase() {
    $pdo = new PDO("sqlite::memory:");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS currency (
            code VARCHAR(3) PRIMARY KEY,
            symbol VARCHAR(4) NOT NULL,
            value DECIMAL NOT NULL,
            base INTEGER NOT NULL DEFAULT 0
        );
        
        INSERT INTO currency 
            (code, symbol, value, base)
        VALUES 
            ('BRL', 'R$', 1.00, 1),
            ('USD', '$', 3.80, 0),
            ('EUR', '€', 4.34, 0);
    ");

    return $pdo;
}