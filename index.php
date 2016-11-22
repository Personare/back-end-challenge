<?php

use Api\Rest\Rest;
use Api\Cotacao\Cotacao;
use Api\Moeda\Moeda;

//use Api\Rest\Rest;

spl_autoload_register(function ($class) {
  require_once(str_replace('\\', '/', $class . '.php'));
});


$rest = new Rest($_SERVER); 


if ( $rest->isValid() ) {
    
    $parametros = $rest->getParametros();
    
    $cotacao = new Cotacao();
    
    $moeda = new Moeda($cotacao);
    
    $moeda->setMoedaEntrada($parametros['entrada']);
    
    $moeda->setMoedaSaida($parametros['saida']);
    
    $conversao = $moeda->converte($parametros['valor']);
    
    echo json_encode($conversao); //retorna a moeda convertida
}



