<?php
namespace CoinConversion;

use CoinConversion\Currency\Currency;
use CoinConversion\Quotation\Quotation;

interface CoinConversionDS
{
    /**
     * @param Currency $from
     * @param Currency $to
     * @return Quotation
     */
    public function getQuotation(Currency $from, Currency $to);
}
