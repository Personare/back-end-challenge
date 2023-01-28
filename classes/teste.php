<?php

/**
 * ===================================================================================== *
 * A função "metodo", verificará se a requisição esta com o metodo correto.
 * Só responderá em caso do método estiver incorreto com o padrão adotado para esta API.
 * ===================================================================================== *
 * A função "pares", verificará se o parametro "par" corresponde a um dos pares do 
 * array da função.
 * ===================================================================================== *
 * A função "numero", verificará se os parametros "qtd" e "cot" são números. Excluindo
 * a qualquer caracter sem ser ponto flutuante.
 * ===================================================================================== *
 * A função "indiceArray", verificará se os indices passados pelo metodo estão corretos
 * ===================================================================================== *
 */

class Teste
{

    public function mensagem($erro, $codigo, $descricao, $mensagem)
    {
        if ($codigo == 400) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode([
                "erro" => $erro,
                "descricao" => $descricao,
                "mensagem" => $mensagem,
                "exemplo" => ['par' => 'USD-BRL', 'qtd' => '11.3', 'cot' => '0.19']
            ]);
            exit;
        } elseif ($codigo == 405) {
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode([
                "erro" => $erro,
                "descricao" => $descricao,
                "mensagem" => $mensagem
            ]);
            exit;
        }
    }

    public function metodo($metodo)
    {
        if ($metodo != 'POST') {
            $this->mensagem(
                "CM001",
                405,
                "Método não permitido: ${metodo}",
                "Utilize o metodo POST para realizar a requisicao"
            );
        }
    }

    public function indiceArray($var = null)
    {
        $indices = ['par', 'qtd', 'cot'];
        foreach ($var as $row) {
            if (!in_array($row, $indices)) {
                $this->mensagem(
                    "CM002",
                    400,
                    "Solicitacao incorreta",
                    "Verifique se os parametros estao corretos para realizar a requisicao"
                );
            }
        }
    }

    public function pares($par)
    {
        if (isset($par)) {
            $pares = ['BRL-USD', 'USD-BRL', 'BRL-EUR', 'EUR-BRL'];

            if (!in_array(mb_strtoupper($par), $pares)) {
                $this->mensagem(
                    "CM003",
                    400,
                    "Solicitacao incorreta",
                    "Par invalido. Utilize uma das opçoes: BRL, USD ou EUR"
                );
            }
        } else {
            $this->mensagem(
                "CM004",
                400,
                "Solicitacao incorreta",
                "Verifique se os parametros estao corretos para realizar a requisicao"
            );
        }
    }

    public function numero($var = null)
    {

        if (isset($var)) {
            if (!is_numeric($var) || $var <= 0) {
                $this->mensagem(
                    "CM004",
                    400,
                    "Solicitacao incorreta",
                    "Verifique se os parametros estao corretos para realizar a requisicao"
                );
            }
        }
    }


    public function parametros($var = null)
    {
        $this->indiceArray(array_keys($var));
        $this->pares($var['par']);
        $this->numero($var['qtd']);
        $this->numero($var['cot']);
    }
}
