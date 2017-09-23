<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once (ROOT . DS . 'config' . DS . 'config.php');
require_once (ROOT . DS . 'libs' . DS . 'core.php');

function __autoload($className) {
    if (file_exists(ROOT . DS . 'libs' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'libs' . DS . strtolower($className) . '.php');
    } else {
        throw new Exception("Class '$className' not found");
    }
}

$api = new API($db_config);
$api->executeCommand();
