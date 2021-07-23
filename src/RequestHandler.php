<?php

declare(strict_types=1);

namespace CurrencyConverter;

//Criando a classe requestHundler que vai manipular as solicitações.
class RequestHandler
{
    private $params;
    private $required_keys;

    //Criando a função de contrução que tem um paramentro.
    public function __construct($params)
    {
        $this->params = $params;
        $this->required_keys = ['from', 'to', 'value'];
    }

    //Criando a função de limpeza dos paramentros, caso seja colocado tudo em letras minuscula, sera convertido para maiusculo.
    public function sanitizedParams(): array
    {
        $this->checkValidParams();

        $this->params['from'] = strtoupper($this->params['from']);
        $this->params['to'] = strtoupper($this->params['to']);
        $this->params['value'] = floatval($this->params['value']);

        return $this->params;
    }

    //Cirando a função de checagem se os paramentros são validos ou não.
    private function checkValidParams(): void
    {
        foreach ($this->required_keys as $required_key) {
            if (empty($this->params[$required_key])) {
                throw new InvalidParametersException(
                    "Por favor na URL coloque ?from=<moeda>&to=<moeda>&value=<valor> com uma barra antes, apenas substitua a onde tem <moeda><moeda><valor> e dei enter ^^"
                );
            }
        }
    }
}

//Classe do error.
class InvalidParametersException extends \Exception
{
}
