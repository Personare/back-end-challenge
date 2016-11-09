<?php
namespace CoinConversion\Quotation;

use CoinConversion\Currency\Currency;
use CoinConversion\Environment;
use CoinConversion\Quotation;
use CoinConversion\QuotationDSFactory;

class QuotationFixture
{
    /** @var Quotation\QuotationDS */
    private $quotationDS;

    /**
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->quotationDS = QuotationDSFactory::build($environment);
    }

    public function reload()
    {
        $this->quotationDS->truncate();
    }

    /**
     * @param Currency $from
     * @param Currency $to
     * @param float $value
     */
    public function insert($from, $to, $value)
    {
        $this->quotationDS->persist($from, $to, $value);
    }
}
