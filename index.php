<?php
require 'vendor/autoload.php';
require 'config.php';

use Src\Controller\QuotationController as QuotationController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$userQuotation = null;
if (!isset($uri[1])) {
    header("HTTP/1.1 404 Not Found");
     exit();
}

$userQuotation = $uri[1];

$controller = new QuotationController($userQuotation, QUOTATIONS_PATH);
$response = $controller->processRequest();
header($response['status_code_header']);
echo $response['body'];
