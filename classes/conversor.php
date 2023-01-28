<?php

class Conversor
{
    public function converter($var = null)
    {
        $valor = $var['qtd'] * $var['cot'];
        $moeda = explode("-", $var['par']);

        echo json_encode([
            "par" => $var['par'],
            "moeda_base" => $moeda[0],
            "qtd_moeda_base" => $var['qtd'],
            "moeda_cotada" => $moeda[1],
            "valor" => $valor
        ]);
    }
}
