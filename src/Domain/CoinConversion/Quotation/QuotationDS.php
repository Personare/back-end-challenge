<?php
namespace CoinConversion\Quotation;

use CoinConversion\Currency\Currency;

interface QuotationDS
{
    /**
     * @param Currency $from
     * @param Currency $to
     * @return Quotation
     */
    public function getQuotation(Currency $from, Currency $to);

    /**
     * @param Currency $from
     * @param Currency $to
     * @param float $quotationValue
     */
    public function persist(Currency $from, Currency $to, $quotationValue);

    /**
     * Remove all rows and reset auto increment id.
     */
    public function truncate();
}
