<?php

declare(strict_types=1);

namespace CurrencyConverter;

//Criando a classe de ResponseHandler, essa classe irá manipular as respostas da API.
class ResponseHandler
{
    private $response;
    private $status_code;

    //Criando a Função buildResponse que tem como parametro 2 variaveis.
    public function buildResponse($response, $status_code): void
    {
        $this->response = $response; 
        $this->status_code = $status_code;
    }

    //Criando a função e excessão, como erros.
    public function buildException($message, $status_code): void
    {
        $this->buildResponse(array('error' => $message), $status_code);
    }

    //Criando a função que ira imprimir na tela.
    public function output(): void
    {
        $this->header();

        echo json_encode($this->response);
    }

    //Criando a função de resposta do http.
    protected function header(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        http_response_code($this->status_code);
    }
}
