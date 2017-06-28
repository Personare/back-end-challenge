<?php

require_once(__DIR__ . '/../config/application.php');
require_once('RequestHandler.php');
require_once('Calculator.php');
require_once('ResponseHandler.php');

use \CurrencyConverter\ResponseHandler as ResponseHandler;
use \CurrencyConverter\RequestHandler as RequestHandler;
use \CurrencyConverter\Calculator as Calculator;
use \CurrencyConverter\InvalidParametersException as InvalidParametersException;
use \CurrencyConverter\RateNotFoundException as RateNotFoundException;
use \CurrencyConverter\SymbolNotFoundException as SymbolNotFoundException;

try {
    $response_handler = new ResponseHandler();

    $request_handler = new RequestHandler($_GET);
    $params = $request_handler->sanitizedParams();

    $calculator = new Calculator();
    $conversion = $calculator->calculate($params['from'], $params['to'], $params['value']);

    $response_handler->buildResponse($conversion, STATUS_CODE_SUCCESS);
} catch (InvalidParametersException $e) {
    $response_handler->buildException($e->getMessage(), STATUS_CODE_BAD_REQUEST);
} catch (RateNotFoundException $e) {
    $response_handler->buildException($e->getMessage(), STATUS_CODE_NOT_FOUND);
} catch (SymbolNotFoundException $e) {
    $response_handler->buildException($e->getMessage(), STATUS_CODE_NOT_FOUND);
} catch (Exception $e) {
    $response_handler->buildException($e->getMessage(), STATUS_CODE_INTERNAL_SERVER_ERROR);
} finally {
    $response_handler->output();

    exit;
}
