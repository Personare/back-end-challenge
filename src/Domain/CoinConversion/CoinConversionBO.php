<?php
namespace CoinConversion;

use CoinConversion\Currency\Currency;
use CoinConversion\Quotation\Quotation;

class CoinConversionBO
{
    /**
     * @var CoinConversionDS
     */
    private $coinConversionDS;

    /**
     * @param CoinConversionDS $coinConversionDS
     */
    public function __construct($coinConversionDS)
    {
        $this->coinConversionDS = $coinConversionDS;
    }

    /**
     * @param Currency $from
     * @param Currency $to
     * @param float $value
     * @return float
     */
    public function convert(Currency $from, Currency $to, $value)
    {
        /** @var Quotation $quotation */
        $quotation = $this->coinConversionDS->getQuotation($from, $to);
        return $quotation->calculateFor($value);
    }
}
