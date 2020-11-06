<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Max-Age: 1000');

require_once dirname(__FILE__).'/Application/MoedaAppService.php';

const MOEDA = "moeda";
const VALOR = "valor";
const COTACAO = "cotacao";
const TIPOS =  ["real", "dolar", "euro"];

$requestParams = $_REQUEST;

if (!validarParametros($requestParams)) {
    http_response_code(400);
    echo "Requisição inválida";
} else {
    $tipoMoeda = $requestParams[MOEDA];
    $cotacao = $requestParams[COTACAO];
    $valor =  $requestParams[VALOR];
    $appService = new MoedaAppService($tipoMoeda);
    $resp = $appService->getResponse($valor, $cotacao);
    
    http_response_code(200);
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
}

function validarParametros(array $params) : bool {
    if (!isset($params[MOEDA]) || !isset($params[VALOR]) || !isset($params[COTACAO])) { return False; }
    if (!is_numeric($params[VALOR]) || !is_numeric($params[COTACAO])) { return False; }
    if (!in_array($params[MOEDA], TIPOS)) { return False; }
    return True;
}