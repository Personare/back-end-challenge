<?php
/**
 * @package Source
 * @category Model
 */

/**
 * Classe Conversao
 *
 * @todo 
 *
 * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
 * @copyright Copyright (c) 2021 Pesonare
 */

class Cotacao{
    
    private $api;
    
    function __construct(){
        $this->api = new API("file-get");
    }
    
    /**
     * Metodo cotacaoDiaria
     *
     * Consulta a API de cotação de acordo com a moeda de entrada e saída
     * 
     * @param string $siglaEntrada Sigla de entrada para a consulta na API
     * @param string $siglaSaida Sigla de saída para a consulta na API
     *
     * @return float valor da cotação
     *
     * <code>
     * <?php
     * $cotacao = $this->cotacao->cotacaoDiaria($this->moeda->getMoedaEntrada(),$this->moeda->getMoedaSaida());
     * $resultado = $this->getValor() * $cotacao;
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    function cotacaoDiaria($siglaEntrada, $siglaSaida){
        $json = $this->api->getJson("https://economia.awesomeapi.com.br/". $siglaEntrada . "-" . $siglaSaida . "/1");
        return $json[0]->ask;
    }
    
}    
