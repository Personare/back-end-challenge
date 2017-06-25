<?php

# Currency Converter

$rates = json_decode(file_get_contents('rates.json'), true);
$symbols = json_decode(file_get_contents('symbols.json'), true);

$from = strtoupper($_GET['from']);

$to = strtoupper($_GET['to']);

$value = number_format(floatval($_GET['value']), 2);

$rate = $rates[$from][$to];

$converted_value = number_format($value * $rate, 2);


$output['original_value'] = $symbols[$from] . ' ' . $value;
$output['converted_value'] = $symbols[$to] . ' ' . $converted_value;

echo json_encode($output);

?>
