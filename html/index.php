<?php
require __DIR__ . '/../vendor/autoload.php';

use CoinConversion\CoinConversionController;

echo CoinConversionController::getInstance()->doConversion($_GET);
