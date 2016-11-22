<?php
namespace Api\Moeda;

/**
 * Classe de conversao de moedas
 * 
 * @author Andre Eppinghaus
 *        
 */
interface MoedaInterface
{
    /**
     * Moeda de corrente
     * @param string $tipoEntrada
     */
    public function setMoedaEntrada($tipoEntrada);
    /**
     * Moeda de conversao
     * @param string $tipoSaida
     */
    public function setMoedaSaida($tipoSaida);
    /**
     * Método de conversao
     * @param float $valor
     * @return float
     */
    public function converte($valor);
    
    /**
     * Verifica se o tipo da moeda é válida
     * @param string $moeda
     */
    public function validaMoeda($tipo);
    
}

