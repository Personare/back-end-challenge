<?php

namespace Personare\Helpers;

class Response
{
    /**
     * Define a resposta Json para API
     * @param $code
     * @param $data
     */
    function jsonResponse($code, $data)
    {
        //Remove notices & warnings
        ob_clean();

        //Limpa variaveis do cabeçalho da requisição
        header_remove();

        // Define o tipo de conteudo no objeto de retorno
        header("Content-type: application/json;");

        //Define o código de resposta
        http_response_code($code);


        // Transforma os dados recebidos em JSON - Parâmetros API
        echo json_encode($data);

        //Validando para que não exista possíveis adições
        exit();
    }
}
