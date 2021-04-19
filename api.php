<?php
include("/Users/orbitive/www/back-end-challenge/autoload.php");

error_reporting(E_ALL ^ E_NOTICE);

try {
    
    $moedaEntrada   = $_GET['de'];
    $moedaSaida     = $_GET['para'];
    $valorConversao = $_GET['valor'];
    $tipoConversao  = $_GET['tipo'];

    $moeda = new Moeda($moedaEntrada,$moedaSaida);
    
    // validações de entrada de dados
    if ($moeda->validarMoeda($moedaEntrada) && $moeda->validarMoeda($moedaSaida) && $valorConversao > 0){
        // Validação para o tipo de consulta
        if(isset($tipoConversao) &&  $tipoConversao == "api"){
            $conversao = new Conversao($moedaEntrada, $moedaSaida, $valorConversao, 0, "api");
            print_r($conversao->converter());
        }
    } else {
        throw new Exception('Parametros de entrada não definidos corretamente! Utilize: BRL, USD ou EUR. Verifique os parametros: de, para, valor e tipo');
    }
} catch (Exception $e) {

    echo 'Exceção capturada: ' . $e->getMessage() . "<br /><br />";

}

?>

