<?php
namespace CoinConversion\Quotation;

use CoinConversion\Currency\Currency;

class Quotation
{
    /**
     * @var Currency
     */
    private $from;
    /**
     * @var Currency
     */
    private $to;
    /**
     * @var float
     */
    private $quotationValue;

    /**
     * @param Currency $from
     * @param Currency $to
     * @param float $quotationValue
     */
    public function __construct(Currency $from, Currency $to, $quotationValue)
    {
        $this->from = $from;
        $this->to = $to;
        $this->quotationValue = $quotationValue;
    }

    /**
     * @param float $value
     * @return float
     */
    public function calculateFor($value)
    {
        return $this->quotationValue * $value;
    }
}
