<?php
include("/Users/orbitive/www/back-end-challenge/autoload.php");

error_reporting(E_ALL ^ E_NOTICE);

try {
    
    $moedaEntrada   = $_GET['de'];
    $moedaSaida     = $_GET['para'];
    $valor          = $_GET['valor'];

    $moeda = new Moeda($moedaEntrada,$moedaSaida);

    if ($moeda->validarMoeda($_GET["de"]) && $moeda->validarMoeda($_GET["para"])) {
        
        $conversao = new Conversao($moedaEntrada, $moedaSaida, $valor);
        print_r($conversao->json());
        
    } else {
        throw new Exception('Parametros de entrada não definidos corretamente! Utilize: BRL, USD ou EUR');
    }
} catch (Exception $e) {

    echo 'Exceção capturada: ' . $e->getMessage() . "<br /><br />";

}

?>

