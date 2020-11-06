<?php

abstract class Moeda {
    protected $cotacao;

    public function setCotacao($cotacao) {
        $this->cotacao = $cotacao;
    }

    public function converter(float $valor) : float {
        $result = $valor * $this->cotacao;
        return round($result, 2);
    }

    abstract public function simbolo() : string;
}

