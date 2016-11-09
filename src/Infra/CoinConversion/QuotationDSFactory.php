<?php
namespace CoinConversion;

use CoinConversion\Quotation\MysqlQuotationDS;
use CoinConversion\Quotation\QuotationDS;

class QuotationDSFactory
{
    /**
     * @param Environment $environment
     * @return QuotationDS
     */
    public static function build(Environment $environment)
    {
        return new MysqlQuotationDS($environment);
    }
}
