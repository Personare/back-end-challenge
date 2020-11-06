<?php

class AppResponse {
    public string $simbolo;
    public float $resultado;

    public function getResponse() : array {
        return array("símbolo" => $this->simbolo, "resultado" => $this->resultado);
    }
}