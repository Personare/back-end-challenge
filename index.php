<?php

require_once 'config.php';

$rates = json_decode(file_get_contents(RATES_FILE), true);
$symbols = json_decode(file_get_contents(SYMBOLS_FILE), true);

$from = strtoupper($_GET['from']);
$to = strtoupper($_GET['to']);
$value = number_format(floatval($_GET['value']), DECIMALS);

$rate = $rates[$from][$to];

$converted_value = number_format($value * $rate, DECIMALS);

$output['original_value'] = $symbols[$from] . ' ' . $value;
$output['converted_value'] = $symbols[$to] . ' ' . $converted_value;

echo json_encode($output);

?>
