<?php
namespace CoinConversion;

use CoinConversion\Currency\Currency;
use CoinConversion\Currency\CurrencyQuote;
use CoinConversion\Quotation\QuotationDS;

class CoinConversionBO
{
    /**
     * @var QuotationDS
     */
    private $coinConversionDS;

    /**
     * @param QuotationDS $coinConversionDS
     */
    public function __construct(QuotationDS $coinConversionDS)
    {
        $this->coinConversionDS = $coinConversionDS;
    }

    /**
     * @param Currency $from
     * @param Currency $to
     * @param float $value
     * @return CurrencyQuote
     */
    public function convert(Currency $from, Currency $to, $value)
    {
        $quotation = $this->coinConversionDS->getQuotation($from, $to);
        $quotedPrice = $quotation->calculateFor($value);
        return new CurrencyQuote($to, $quotedPrice);
    }
}
