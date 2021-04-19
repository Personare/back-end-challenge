<?php
include("/Users/orbitive/www/back-end-challenge/autoload.php");

error_reporting(E_ALL ^ E_NOTICE);

try {
    
    $moedaEntrada   = $_GET['de'];
    $moedaSaida     = $_GET['para'];
    $valorConversao = $_GET['valor'];
    $valorCotacao   = $_GET['cotacao'];

    $moeda = new Moeda($moedaEntrada,$moedaSaida);
    
    // validações de entrada de dados
    if ($moeda->validarMoeda($moedaEntrada) && $moeda->validarMoeda($moedaSaida) && isset($valorCotacao) ){
            $conversao = new Conversao($moedaEntrada, $moedaSaida, $valorConversao, $valorCotacao);
            print_r($conversao->converter());
        
    } else {
        throw new Exception('Parametros de entrada não definidos corretamente! Utilize: BRL, USD ou EUR. Verifique os parametros: de, para, valor e cotacao');
    }
} catch (Exception $e) {

    echo 'Exceção capturada: ' . $e->getMessage() . "<br /><br />";

}

?>

