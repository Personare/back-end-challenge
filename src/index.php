<?php

require_once('RequestHandler.php');
require_once('Calculator.php');
require_once('ResponseHandler.php');

use \CurrencyConverter\RequestHandler as RequestHandler;
use \CurrencyConverter\Calculator as Calculator;
use \CurrencyConverter\ResponseHandler as ResponseHandler;
use \CurrencyConverter\InvalidParametersException as InvalidParametersException;
use \CurrencyConverter\RateNotFoundException as RateNotFoundException;

try {
    $response_handler = new ResponseHandler();

    $request_handler = new RequestHandler($_GET);
    $params = $request_handler->sanitizedParams();

    $calculator = new Calculator();
    $conversion = $calculator->calculate($params['from'], $params['to'], $params['value']);

    $response_handler->buildResponse($conversion, 200);
} catch (InvalidParametersException $e) {
    $response_handler->buildException($e->getMessage(), 400);
} catch (RateNotFoundException $e) {
    $response_handler->buildException($e->getMessage(), 404);
} catch (Exception $e) {
    $response_handler->buildException($e->getMessage(), 500);
} finally {
    $response_handler->output();
}
