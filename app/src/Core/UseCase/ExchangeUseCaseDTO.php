<?php

namespace App\Core\UseCase;

class ExchangeUseCaseDTO implements IRequest
{
    private string $from;
    private string $to;
    private float $value;
    private float $cotation;

    public function __construct(array $params)
    {
        $this->validate($params);
        $this->from = $params['from'];
        $this->to = $params['to'];
        $this->value = $params['value'];
        $this->cotation = $params['cotation'];
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCotation(): float
    {
        return $this->cotation;
    }

    public function validate(array $params):void
    {

        $err = [];

        if (empty($params['from'])) {
            array_push($err, 'inform from');
        }

        if (empty($params['to'])) {
            array_push($err, 'inform to');
        }

        if (empty($params['value']) || !is_numeric($params['value'])) {
            array_push($err, 'inform numeric value with .');
        }

        if (empty($params['cotation']) || !is_numeric($params['cotation'])) {
            array_push($err, 'inform numeric cotation with .');
        }

        if (!empty($err)) {
            throw new \InvalidArgumentException(implode(',', $err), 404);
        }
    }
}
