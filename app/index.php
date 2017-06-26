<?php

require_once('RequestHandler.class.php');
require_once('Calculator.class.php');
require_once('ResponseHandler.class.php');

$response_handler = new \CurrencyConverter\ResponseHandler();

try {
    $request_handler = new \CurrencyConverter\RequestHandler($_GET);
    $params = $request_handler->validParams();

    $calculator = new \CurrencyConverter\Calculator(
        $params['from'],
        $params['to'],
        $params['value']
    );

    $conversion = $calculator->calculate();

    $response_handler->printConversion($conversion);
} catch (\CurrencyConverter\RateNotFoundException $e) {
    $response_handler->printException($e->getMessage(), 404);
} catch (\CurrencyConverter\InvalidParametersException $e) {
    $response_handler->printException($e->getMessage(), 400);
} catch (Exception $e) {
    $response_handler->printException($e->getMessage(), 500);
}
