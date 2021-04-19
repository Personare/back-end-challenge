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
    private $valorCotacao;
    
    function __construct(){
        $this->api = new API("file-get");
    }
    
    function getValorCotacao() {
        return $this->valorCotacao;
    }

    function setValorCotacao($valorCotacao) {
        $this->valorCotacao = $valorCotacao;
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
        // cotacao do dia em uma data especifica para realização de testes
        $json = $this->api->getJson("https://economia.awesomeapi.com.br/json/daily/". $siglaEntrada . "-" . $siglaSaida . "/?start_date=20210415");
        // cotacao do dia em tempo real
        //$json = $this->api->getJson("https://economia.awesomeapi.com.br/". $siglaEntrada . "-" . $siglaSaida . "/1");
        return $json[0]->ask;
    }
    
}    
