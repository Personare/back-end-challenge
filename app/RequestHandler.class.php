<?php

namespace CurrencyConverter;

class RequestHandler
{
    public function __construct($params)
    {
        $this->params = $params;
        $this->required_keys = ['from', 'to', 'value'];
    }

    public function validParams()
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
