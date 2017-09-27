<?php

class IndexController extends VanillaController
{

    function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->doNotRenderHeader = 1;
    }

    function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->validate_method(array('GET'));
        $documentacao = array(
            "/" => "Documentação de utilização da api",
            "/moedas" => array(
                "/" => array(
                    "Métodos" => array("GET"),
                    "Resultado" => "Retorna um array com o total de resultados e as os objetos das moedas cadastradas",
                    "Exemplo de Retorno" => array(
                        "count" => 2,
                        "results" => array(
                            array(
                                'id' => 1,
                                'nome' => 'Real Brasileiro',
                                'simbolo' => 'R$',
                                'sigla' => 'BRL'
                            ),
                            array(
                                'id' => 2,
                                'nome' => 'U.S. Dollar',
                                'simbolo' => '$',
                                'sigla' => 'USD'
                            )
                        )
                    )
                ),
                "/view/{id}" => array(
                    "Métodos" => array("GET"),
                    "Resultado" => "Retorna um objeto com os dados da moeda buscada através do seu id",
                    "Exemplo de Retorno" => array(
                        'id' => 1,
                        'nome' => 'Real Brasileiro',
                        'simbolo' => 'R$',
                        'sigla' => 'BRL'

                    ),
                ),
                "/add" => array(
                    "Métodos" => array("POST"),
                    "Resultado" => "Cadastra uma moeda no banco de dados retornando o objeto cadastrado ou um objeto de erro caso os dados estejam incorretos",
                    "Exemplo de Requisição" => array(
                        'nome' => 'Euro',
                        'simbolo' => '€',
                        'sigla' => 'EUR'
                    ),
                    "Exemplo de Retorno" => array(
                        'id' => 3,
                        'nome' => 'Euro',
                        'simbolo' => '€',
                        'sigla' => 'EUR'
                    )
                ),
                "/update/{id}" => array(
                    "Métodos" => array("PUT"),
                    "Resultado" => "Atualiza uma moeda no banco de dados, de acordo com o id informado, retornando o objeto atualizado ou um objeto de erro caso os dados estejam incorretos",
                    "Exemplo de Requisição" => array(
                        'nome' => 'Libras Esterlinas',
                        'simbolo' => '€',
                        'sigla' => 'EUR'
                    ),
                    "Exemplo de Retorno" => array(
                        'id' => 3,
                        'nome' => 'Libras Esterlinas',
                        'simbolo' => '€',
                        'sigla' => 'EUR'
                    )
                ),
                "/delete/{id}" => array(
                    "Métodos" => array("DELETE"),
                    "Resultado" => "Apaga a moeda referente ao id informado",
                    "Exemplo de Retorno" => array(
                        "sucesso" => "Moeda {nome_da_moeda} removida com sucesso!"
                    )
                ),
                "/converter/{moeda_origem_id}/{moeda_destino_id}" => array(
                    "Métodos" => array("POST"),
                    "Resultado" => "Converte o valor enviado por parametro baseado na cotação enviada por parametro entre as moedas informadas pelos ids",
                    "Exemplo de Requisição" => array(
                        'valor' => '10.00',
                        'cotacao' => '4.00'
                    ),
                    "Exemplo de Retorno" => array(
                        'moeda_origem' => 'BRL - Brazillian Real',
                        'moeda_destino' => 'USD - U.S. Dollar',
                        'valor' => '10.00',
                        'cotacao' => '4.00',
                        'valor_convertido' => '$ 2.50',
                    )
                )
            )
        );
        echo json_encode($documentacao);
    }
}