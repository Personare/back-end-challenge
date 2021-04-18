<?php
/**
 * @package Source
 * @category Model
 */

/**
 * Classe Conversão
 * 
 * Classe para a conversão de valores nas moedas Real, Dollar e Euro
 *
 * @todo 
 *
 * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
 * @copyright Copyright (c) 2021 Pesonare
 */

class Conversao{
    
    protected   $valor;
    private     $cotacao;
    private     $moeda;

    function __construct($entrada,$saida,$valor){
        
        $this->cotacao  = new Cotacao();
        $this->moeda    = new Moeda($entrada,$saida);
        $this->setValor($valor);
        
    }

    function getValor() {
        return $this->valor;
    }

    function setValor($valor) {
        $this->valor = $valor;
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
        $cotacao = $this->cotacao->cotacaoDiaria($this->moeda->getMoedaEntrada(),$this->moeda->getMoedaSaida());
        $resultado = $this->getValor() * $cotacao;
        return $this->moeda->formatarNumero($resultado);
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
        $array = [
            "resultado" => $this->resultado(),
            "simbolo" => $this->moeda->retornarSimbolo()
        ];
        return $array;
    }
    
    /**
     * Metodo json
     *
     * Converte o $array para o formato json
     * 
     * @param null
     *
     * @return json dados no formato json
     *
     * <code>
     * <?php
     * print_r($this->json());
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    function json(){
        return json_encode($this->converter());
    }

}
