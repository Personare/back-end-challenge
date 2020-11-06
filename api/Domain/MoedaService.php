<?php
require_once dirname(__FILE__).'/Real.php';
require_once dirname(__FILE__).'/Dolar.php';
require_once dirname(__FILE__).'/Euro.php';

class MoedaService {
    protected $moedaClass;

    public function __construct(string $tipoMoeda) {
        $this->moedaClass = $this->getMoeda($tipoMoeda);
    }

    public function converter(float $valor, float $cotacao) : float {
        $this->moedaClass->setCotacao($cotacao);
        return $this->moedaClass->converter($valor);
    }

    public function getSimbolo() : string {
        return $this->moedaClass->simbolo();
    }

    public function getMoeda(string $tipo) : Moeda{
        switch ($tipo) {
            case "real":
                return new Real();
                break;
            case "dolar":
                return new Dolar();
                break;
            case "euro":
                return new Euro();
                break;
            default:
                throw new Exception("Moeda não suportada");
          }
    }
}

