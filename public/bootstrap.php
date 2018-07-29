<?php

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT', realpath(__DIR__ . DS . '..'));

$composer_autoload = APP_ROOT . DS . 'vendor' . DS . 'autoload.php';
if (!@include($composer_autoload)) {

    /* Include path */
    set_include_path(implode(PATH_SEPARATOR, array(
        APP_ROOT . DS . 'src',
        get_include_path(),
    )));

    /* PEAR autoloader */
    spl_autoload_register(
        function($className) {
            $filename = strtr($className, '\\', DIRECTORY_SEPARATOR) . '.php';
            foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
                $path .= DIRECTORY_SEPARATOR . $filename;
                if (is_file($path)) {
                    require_once $path;
                    return true;
                }
            }
            return false;
        }
    );
}

function createFakeDatabase() {
    $pdo = new PDO("sqlite::memory:");
    $pdo->exec("
            CREATE TABLE IF NOT EXISTS currency (
                code VARCHAR(3) PRIMARY KEY,
                symbol VARCHAR(10) NOT NULL,
                value DECIMAL NOT NULL,
                base INTEGER NOT NULL DEFAULT 0
            );
            
            INSERT INTO currency 
                (code, symbol, value, base) 
            VALUES 
                ('USD', '$', 3.71, 0),
                ('EUR', '€', 4.33, 0),
                ('BRL', 'R$', 1.00, 1);
        ");

    return $pdo;
}
