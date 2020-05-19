<?php declare(strict_types = 1);

namespace App\Service;

use App\Entity\Currency\ICurrency;

class Exchange
{
    protected ICurrency $from;

    protected ICurrency $to;

    /** @var array<int, array<string, string>> */
    protected array $allowedConversions = [
        [
            'BRL' => 'USD',
        ],
        [
            'USD' => 'BRL',
        ],
        [
            'BRL' => 'EUR',
        ],
        [
            'EUR' => 'BRL',
        ],
    ];

    public function setFrom(ICurrency $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setTo(ICurrency $to): self
    {
        $this->to = $to;

        return $this;
    }

    /** @return array{valorConvertido: float, simboloMoeda: string} */
    public function getConvertedData(float $value, float $rate): array
    {
        if (!$this->isAllowedConversion()) {
            throw new \InvalidArgumentException('Conversão não permitida!');
        }

        return [
            'valorConvertido' => $this->convert($value, $rate),
            'simboloMoeda' => $this->to->getSimbol(),
        ];
    }

    private function isAllowedConversion(): bool
    {
        foreach ($this->allowedConversions as $allowedConversion) {
            if (!isset($allowedConversion[$this->from->getIsoAbbreviation()])) {
                continue;
            }

            if ($allowedConversion[$this->from->getIsoAbbreviation()] === $this->to->getIsoAbbreviation()) {
                return true;
            }
        }

        return false;
    }

    private function convert(float $ammount, float $rate): float
    {
        if ($ammount <= 0) {
            throw new \InvalidArgumentException(
                'A quantidade a ser convertida precisa ser maior que 0',
            );
        }

        if ($rate <= 0) {
            throw new \InvalidArgumentException(
                'A taxa de conversão precisa ser maior que 0',
            );
        }

        return $ammount * $rate;
    }
}
