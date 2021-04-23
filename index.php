<?php

require __DIR__.'/vendor/autoload.php';


$request = new \Personare\Helpers\TratamentoRequest();
$checkedRequest = array();
$checkedRequest = $request->request();

$cotacao = array();
$calculoCotacao = new \Personare\Helpers\CalculaCotacao();
$cotacao = $calculoCotacao->CalculaValor($checkedRequest);

$response = new \Personare\Helpers\Response();
$response->jsonResponse(200,$cotacao);
