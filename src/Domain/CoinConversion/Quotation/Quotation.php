<?php
namespace CoinConversion\Quotation;

use CoinConversion\Currency\BrlCurrency;
use CoinConversion\Currency\UsdCurrency;

class Quotation
{
    /**
     * @var BrlCurrency
     */
    private $from;
    /**
     * @var UsdCurrency
     */
    private $to;
    /**
     * @var float
     */
    private $value;

    /**
     * @param BrlCurrency $from
     * @param UsdCurrency $to
     * @param float $value
     */
    public function __construct($from, $to, $value)
    {
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
    }

    public function calculateFor($value)
    {
        return $this->value * $value;
    }
}
