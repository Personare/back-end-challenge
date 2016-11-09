<?php
namespace CoinConversion;

use CoinConversion\Environment\LocalEnvironment;
use CoinConversion\Quotation\MysqlQuotationDS;

class CoinConversionBOFactory
{
    /**
     * @return CoinConversionBO
     */
    public static function build()
    {
        $quotationDS = new MysqlQuotationDS(new LocalEnvironment());
        return new CoinConversionBO($quotationDS);
    }
}
