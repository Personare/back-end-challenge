<?php

/* IMPORTAR BIBLIOTECAS */

require "/composer/vendor/wixel/gump/gump.class.php";
include("Classe_Conversor.php");

header("Content-Type: application/json");

/* RECEBER DADOS DO FRONT-END */

$valor = $_GET['valor'];
$cotacao = $_GET['cotacao'];
$tipo_de = $_GET['tipo_de'];
$tipo_para = $_GET['tipo_para'];

/* CRIAR ARRAIS DE DADOS E VALIDAÇÕES */

$data = array(
               'valor' => $valor,
			   'cotacao' => $cotacao,
			   'tipo_de' => $tipo_de,
			   'tipo_para' => $tipo_para
			   );
			   
$regras = array(
               'valor' => 'required|numeric',
			   'cotacao' => 'required|numeric',
			   'tipo_de' => 'required',
			   'tipo_para' => 'required'
			   );
			   
/* REALIZAR CONVERSÃO */
			   
$Conv = new Conversor();
$Conv->valor = $data['valor'];
$Conv->cotacao = $data['cotacao'];
$Conv->tipo_de = $data['tipo_de'];
$Conv->tipo_para = $data['tipo_para'];
$resposta = strval($Conv->converter());
$resposta = $Conv->simbolo().$resposta;
$resposta = array('resposta' => $resposta);

/* VALIDAR DADOS */

$is_valid = GUMP::is_valid($data, $regras);

/* RETORNAR DADOS */

$resp = json_encode($resposta);

if($is_valid === true){
	echo $resp;
} else {
	echo $is_valid;
}
?>