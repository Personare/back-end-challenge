<?php
require_once dirname(__FILE__).'/../Domain/MoedaService.php';
require_once dirname(__FILE__).'/Model/AppResponse.php';

class MoedaAppService {
    protected $moedaService;

    public function __construct(string $tipoMoeda) {
        $this->moedaService = new MoedaService($tipoMoeda);
    }

    public function converter(float $valor, float $cotacao) : float {
        return $this->moedaService->converter($valor, $cotacao);
    }

    public function getSimbolo() : string {
        return $this->moedaService->getSimbolo();
    }

    public function getResponse(float $valor, float $cotacao) : array {
        $resp = new AppResponse();
        $resp->simbolo = $this->getSimbolo();
        $resp->resultado = $this->converter($valor, $cotacao);

        return $resp->getResponse();
    }
}
