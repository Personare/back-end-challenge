<?php

abstract class Moeda {
    protected $cotacao;

    public function setCotacao($cotacao) {
        $this->cotacao = $cotacao;
    }

    public function converter(float $valor) : float {
        $result = $valor * $this->cotacao;
        return $result;
    }

    abstract public function simbolo() : string;
}

