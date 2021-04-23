<?php

namespace Personare\Helpers;

class TratamentoRequest
{
    private $moedas = array(
        "BRL" => "R$",
        "USD" => "$",
        "EUR" => "€"
    );

    private $response;

    /**
     * TratamentoRequest constructor.
     */
    public function __construct()
    {
        $this->response = new Response();
    }

    /**
     * @param $moeda_origem
     * @param $moeda_destino
     * @return bool
     * @throws \Exception
     */
    public function validaMoeda($moeda_origem,$moeda_destino)
    {
        if(!is_string($moeda_origem) && !is_string($moeda_destino)) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => "Os parametros $moeda_origem e $moeda_destino devem ser do tipo texto"
                ]);
        }
        if(strlen($moeda_origem) != 3 || strlen($moeda_destino) != 3 ) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => "Os parametros $moeda_origem e $moeda_destino devem conter 3 caracteres"
                ]);
        }
        if(!$this->moedas[$moeda_origem]) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => "O parametro $moeda_origem não foi encontrado, favor consultar documentação"
                ]);
        }

        if(!$this->moedas[$moeda_destino]) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => "O parametro $moeda_destino não foi encontrado, favor consultar documentação"
                ]);
        }
        return true;
    }

    /**
     * Verifica possíveis erros diante das cotações solicitadas
     * @param $moeda_origem
     * @param $moeda_destino
     * @return bool
     * @throws \Exception
     */
    public function validaParametroCotacao($moeda_origem, $moeda_destino) {

        if($moeda_origem == $moeda_destino) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => "As moedas não podem ser iguais"
                ]);
        }

        if($moeda_origem == 'BRL' || $moeda_destino == 'BRL') {
            return true;
        }

        $this->response->jsonResponse(400,
            [
                "code" => 400,
                "message" => "Ao menos uma das moedas deve ser BRL"
            ]);

        exit();
    }

    /**
     * Valida os parâmetros de entrada conforme documentação
     * @return bool
     * @throws \Exception
     */
    public function validaParametrosEntrada()
    {
        if(!isset($_GET['moeda_origem'])) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => 'O parametro moeda_origem é obrigatório'
                ]);
        }

        if(!isset($_GET['moeda_destino'])) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => 'O parametro moeda_destino é obrigatório'
                ]);
        }

        if(!isset($_GET['valor'])) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => 'O parametro valor é obrigatório'
                ]);
        }

        if(!isset($_GET['cotacao'])) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => 'O parametro cotacao é obrigatório'
                ]);
        }

        if(!is_numeric($_GET['valor']) || $_GET['valor'] < 0) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => 'O parametro valor deve ser numérico (float) e maior que zero'
                ]);
        }


        if(!is_numeric($_GET['cotacao']) || $_GET['cotacao'] < 0) {
            $this->response->jsonResponse(400,
                [
                    "code" => 400,
                    "message" => 'O parametro cotacao deve ser numérico (float) e maior que zero'
                ]);
        }

        return true;
    }

    /**
     * Após verificação retorna o array montado para o cálculo da cotação
     * @return array
     * @throws \Exception
     */
    public function request()
    {
        if($this->validaParametrosEntrada()) {
            if($this->validaMoeda($_GET['moeda_origem'],$_GET['moeda_destino']) &&
                $this->validaParametroCotacao($_GET['moeda_origem'],$_GET['moeda_destino'])) {
                return array(
                    "tipo_cotacao" => $_GET['moeda_origem'].'-'.$_GET['moeda_destino'],
                    "valor_entrada" => (float) $_GET['valor'],
                    "valor_cotacao" => (float) $_GET['cotacao'],
                    "simbolo" => $this->moedas[$_GET['moeda_destino']]
                );
            }
        }

        $this->response->jsonResponse(500,
            [
                "code" => 500,
                "message" => 'Erro interno do servidor'
            ]);
        exit();
    }

}
