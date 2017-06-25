<?php

require '../config/application.php';

function currency_formatter($value)
{
    return number_format(floatval($value), DECIMALS);
}

$rates = json_decode(file_get_contents(RATES_FILE), true);
$symbols = json_decode(file_get_contents(SYMBOLS_FILE), true);

$from = strtoupper($_GET['from']);
$to = strtoupper($_GET['to']);
$value = currency_formatter($_GET['value']);

$rate = currency_formatter($rates[$from][$to]);

$converted_value = currency_formatter($value * $rate);

$output['original_value'] = "${symbols[$from]} $value";
$output['converted_value'] = "{$symbols[$to]} $converted_value";

echo json_encode($output);
