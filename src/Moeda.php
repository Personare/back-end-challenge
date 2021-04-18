<?php
/**
 * @package Source
 * @category Model
 */

/**
 * Classe Moeda
 *
 * @todo 
 *
 * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
 * @copyright Copyright (c) 2021 Pesonare
 */

class Moeda{
    
    private $sigla;
    private $simbolo;
    private $moedaEntrada;
    private $moedaSaida;
    
    function __construct($entrada,$saida){
        $this->setMoedaEntrada($entrada);
        $this->setMoedaSaida($saida);
    }

    function getSigla() {
        return $this->sigla;
    }

    function getSimbolo() {
        return $this->simbolo;
    }

    function getMoedaEntrada() {
        return $this->moedaEntrada;
    }

    function getMoedaSaida() {
        return $this->moedaSaida;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    function setSimbolo($simbolo) {
        $this->simbolo = $simbolo;
    }

    function setMoedaEntrada($moedaEntrada) {
        $this->moedaEntrada = $moedaEntrada;
    }

    function setMoedaSaida($moedaSaida) {
        $this->moedaSaida = $moedaSaida;
    }
    
    /**
     * Metodo formataNumero
     *
     * @param float $valor com o número que deseja formatar de acordo com o moeda
     *
     * @return float valor formatado
     *
     * <code>
     * <?php
     * $cotacao     = $this->cotacao->cotacaoDiaria($this->moeda->getMoedaEntrada(),$this->moeda->getMoedaSaida());
     * $resultado   = $this->getValor() * $cotacao;
     * return $this->moeda->formatarNumero($resultado);
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    
    function formatarNumero($valor){
        
        return $this->getMoedaSaida() == "BRL" ?  number_format($valor, 2, ",", ".") : number_format($valor, 2, ".", ",");
        
    }
    
    /**
     * Metodo retornarSimbolo
     * 
     * Retorna o simbolo de acordo com a moeda de saída (convertida)
     *
     * @return string retorno do simbolo
     *
     * <code>
     * <?php
     * $array = [
     *      "resultado" => $this->resultado(),
     *      "simbolo" => $this->moeda->retornarSimbolo()
     * ];
     * return $array;
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    function retornarSimbolo(){
        
        try {
            switch ($this->getMoedaSaida()) {
                case "BRL":
                    $simbolo = "R$";
                    break;
                case "USD":
                    $simbolo = "U$";
                    break;
                case "EUR":
                    $simbolo = "€";
                    break;
                default:
                    throw new Exception('Moeda de saída não definido');
                    break;
            }
            return $simbolo;
            
        } catch (Exception $e) {
            
            echo 'Exceção capturada: ',  $e->getMessage() . "<br /><br />";
        }    
    }
    /**
     * Metodo validarMoeda
     * 
     * Validação para verificar se a sigla da moeda é suportada pela API
     *
     * @param string $moeda sigla da moeda a ser validada
     *
     * @return boolean retorna true se a moeda for suportada
     *
     * <code>
     * if ($moeda->validarMoeda($_GET["de"]) && $moeda->validarMoeda($_GET["para"])) { 
     *      $conversao = new Conversao($moedaEntrada, $moedaSaida, $valor);
     *      print_r($conversao->json()); 
     * }
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    function validarMoeda($moeda){
        
        if ($moeda == "BRL" || $moeda == "USD" || $moeda == "EUR") {
            return true;
        } else {
            return false;
        }
    }

}    
