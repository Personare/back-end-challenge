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

    public function sanitizedParams(): array
    {
        $this->checkValidParams();

        $this->params['from'] = strtoupper($this->params['from']);
        $this->params['to'] = strtoupper($this->params['to']);
        $this->params['value'] = floatval($this->params['value']);

        return $this->params;
    }

    private function checkValidParams(): void
    {
        foreach ($this->required_keys as $required_key) {
            if (empty($this->params[$required_key])) {
                throw new InvalidParametersException(
                    "Valid parameters are: 'from', 'to' and 'value'."
                );
            }
        }
    }
}

class InvalidParametersException extends \Exception
{
}
