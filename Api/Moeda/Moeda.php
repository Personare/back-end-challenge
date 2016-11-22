<?php
namespace Api\Moeda;

use Api\Cotacao\Cotacao;

/**
 * Classe responsável pela
 * conversão de moedas
 * @author Andre Eppinghaus
 *        
 */
class Moeda implements MoedaInterface
{
    private $erro, $entrada, $saida;
    private $cotacao;
    /**
     * 
     * @param Cotacao $cotacao
     */
    public function __construct(Cotacao $cotacao)
    {
        $this->cotacao = $cotacao;
        $this->erro = 'Este tipo não é válido use somente USD, EUR ou BRL';
    }

    /**
     * Configura a moeda de saida
     *
     * @see \Api\Moeda\MoedaInterface::setMoedaDestino()
     *
     */
    public function setMoedaSaida($tipoSaida)
    {
        
      //  throw new \InvalidArgumentException();
        
        if (! $this->validaMoeda($tipoSaida)) {
            
            throw new \InvalidArgumentException('saida: '.$this->erro);
        }
        $this->saida = $tipoSaida;
    }

    /**
     * Configura a moeda de entrada
     *
     * @see \Api\Moeda\MoedaInterface::setMoedaOrigem()
     *
     */
    public function setMoedaEntrada($tipoEntrada)
    {
        if (! $this->validaMoeda($tipoEntrada)) {
        
            throw new \InvalidArgumentException('entrada: '.$this->erro);
        }
        
        $this->entrada = $tipoEntrada;
    }
    
    /**
     * 
     * Verifica se a classe suporta este tipo de moeda 
     *
     * @see \Api\Moeda\MoedaInterface::validaMoeda()
     *
     */
    public function validaMoeda($tipo) {
    
        $valida = false;
        
        if ($tipo == "EUR") {
            $valida = true;
        }else if ($tipo == "USD") {
            $valida = true;
        }else if ($tipo == "BRL") {
            $valida = true;
        }
        
        return $valida;
    }
    
    /**
     * Realiza a conversão de moedas
     *
     * @see \Api\Moeda\MoedaInterface::converte()
     *
     */
    public function converte($valor)
    {
        $calculo = 0;
        $saida="";
        
        if ($this->entrada == 'BRL' && $this->saida == 'USD' ) 
        {
            $calculo = $valor /  $this->cotacao->getDolar();
            $saida= "$";
            
        }else if ($this->entrada == 'USD' && $this->saida == 'BRL') 
        {
            $calculo = $valor *  $this->cotacao->getDolar();
            $saida = "R$";
            
        }else if ($this->entrada == 'BRL' && $this->saida == 'EUR') 
        {
            $calculo = $valor /  $this->cotacao->getEuro();
            $saida= "&#8364;";
            
        }else if ($this->entrada == 'EUR' && $this->saida == 'BRL') 
        {
            $calculo = $valor *  $this->cotacao->getEuro();
            $saida = "R$";
        }else {
            throw new \InvalidArgumentException('Esta conversão não é suportada');
        }
        
        $conversao = array('simbolo'=> $saida, 'Valor'=>$calculo);
        
        return $conversao;
    }
}

