<?php
/**
 * @package Source
 * @category Model
 */

/**
 * Classe Conversão
 * 
 * Classe para a conversão de valores nas moedas Real, Dolar e Euro
 *
 * @todo 
 *
 * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
 * @copyright Copyright (c) 2021 Pesonare
 */

class Conversao{
    
    private $valor;
    private $cotacao;
    private $moeda;
    private $tipo;

    function __construct($entrada,$saida,$valor,$valorCotacao,$tipo="parametro"){
        
        $this->cotacao  = new Cotacao();
        $this->cotacao->setValorCotacao($valorCotacao);
        
        $this->moeda    = new Moeda($entrada,$saida);
        
        $this->setValor($valor);
        $this->setTipo($tipo);
        
    }

    function getValor() {
        return $this->valor;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }    
    
    /**
     * Metodo resultado
     *
     * Calular o valor de acordo com a cotação da moeda desejada
     * 
     * @param null
     *
     * @return float valor formatado de acordo com a moeda de saída
     *
     * <code>
     * <?php
     * $this->resultado();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */

    function resultado(){
        
        try {
            // Calculo da conversão via passagem de parametro da cotação
            if ($this->moeda->getMoedaSaida() == "BRL") {
                $resultado = $this->getValor() * $this->cotacao->getValorCotacao();
            } else {
                $resultado = $this->getValor() / $this->cotacao->getValorCotacao();
            }
            return $this->moeda->formatarNumero($resultado);
            
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "<br /><br />";
        }
    }
    /**
     * Metodo resultadoAPI
     *
     * Consultorar o valor da cotação via API e gerar o resultado da conversão
     * 
     * @param null
     *
     * @return float valor formatado de acordo com a moeda de saída
     *
     * <code>
     * <?php
     * $this->resultadoAPI();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    function resultadoAPI(){
        
        try {
            // Leitura da cotação diária via API sem a passagem de parametro de cotação
            if($this->getTipo() == "api"){
                $cotacao = $this->cotacao->cotacaoDiaria($this->moeda->getMoedaEntrada(),$this->moeda->getMoedaSaida());
                $resultado = $this->getValor() * $cotacao;
                return $this->moeda->formatarNumero($resultado);
            }else {
                throw new Exception('Parametros de entrada não definidos corretamente! Verifique o parametro tipo');
            }
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "<br /><br />";
        }
    }

    /**
     * Metodo converter
     *
     * Converte o resultado e simbolo em um $array
     * 
     * @param null
     *
     * @return array array associativo preparado para o metodo json()
     *
     * <code>
     * <?php
     * $this->converter();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    function converter(){
        // verifica o tipo de requisição (parametro ou api)
        $resultado = $this->getTipo() == "parametro" ? $this->resultado() : $this->resultadoAPI();
        $array = [
            "resultado" => $resultado,
            "simbolo" => $this->moeda->retornarSimbolo()
        ];
        return json_encode($array);
    }

}
