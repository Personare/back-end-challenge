<?php

namespace Domain\ValueObject;

class Currency
{
    /**
     * @var string
     */
    private $iso;

    /**
     * @var string
     */
    private $symbol;

    /**
     * Currency constructor.
     * @param null $iso
     * @param null $symbol
     */
    public function __construct($iso = null, $symbol = null)
    {
        $this->iso = $iso;
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getIso(): string
    {
        return $this->iso;
    }

    /**
     * @param string $iso
     */
    public function setIso(string $iso)
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol)
    {
        $this->symbol = $symbol;
    }
}