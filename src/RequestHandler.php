<?php

declare(strict_types=1);

namespace CurrencyConverter;

class RequestHandler
{
    private $params;
    private $required_keys;

    public function __construct($params)
    {
        $this->params = $params;
        $this->required_keys = ['from', 'to', 'value'];
    }

    public function validParams(): array
    {
        foreach ($this->required_keys as $required_key) {
            if (empty($this->params[$required_key])) {
                throw new InvalidParametersException(
                    "Couldn't find valid parameters: 'from', 'to' and 'value'."
                );
            }
        }

        return $this->params;
    }
}

class InvalidParametersException extends \Exception
{
}
