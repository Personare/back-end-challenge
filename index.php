<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

// Definindo Time Zone
date_default_timezone_set("America/Sao_paulo");

// Incluindo autoload
include_once "classes/autoload.php";
new Autoload;

// Instanciando os testes
$testes = new Teste();
$conversor = new Conversor();

// Verificando o metodo da requisição
$metodo = $_SERVER['REQUEST_METHOD'];
$testes->metodo($metodo);


// Recebendo dados via Json
$data = json_decode(file_get_contents('php://input'), true);
$testes->parametros($data);
$conversor->converter($data);
