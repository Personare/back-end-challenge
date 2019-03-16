<?php

$separar = explode("=", $_SERVER["REQUEST_URI"]);
$separartraço = explode("-", $separar['0']);

$moedaEntrada = $separartraço ['0'];
$moedaSaida = $separartraço['1'];
$valorEntrada = $separar ['1'];

function pegarCotacao($ent, $sai){
    $link = "http://download.finance.yahoo.com/d/quotes.csv?s=".$ent.$sai."=X&f=sl1d1t1ba&e=.csv";

    if(@fopen($link,"r")){
        $arq =file($link);
    }

    if(is_array($arq)){
        for($x=0;$x<count($arq);$x++){
            $linha = explode(",", $arq[$x]);
            $result['cotacao'] = $linha[1];

            return $result;
        }
    }
}

$cotacao = pegarCotacao($moedaEntrada, $moedaSaida);

function converter($valor, $cot){
    $result = $valor * $cot;
    return $result;
}

$valorSaida = converter($valorEntrada, $cotacao);

function Simbolo($sai){
    if($sai = 'USD'){
        $result = 'US$';
    } elseif($sai = 'EUR'){
        $result = '€';
    } elseif($sai = 'BRL'){
        $result = 'R$';
    }
    return $result;
}

$simbolo = Simbolo($moedaSaida);
if($moedaSaida = 'EUR'){
    $array = array("Valor" => $valorSaida, "Simbolo" => $simbolo);
} else{
    $array = array("Simbolo" => $simbolo, "Valor" => $valorSaida);
}

$json = json_encode($array);

$ch = curl_init();

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

    'Content-Length: ' . strlen($json))

);

$jsonRet = json_decode(curl_exec($ch));

?>