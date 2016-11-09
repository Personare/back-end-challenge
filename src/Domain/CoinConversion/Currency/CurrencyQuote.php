<?php
namespace CoinConversion\Currency;

class CurrencyQuote
{
    /**
     * @var Currency
     */
    private $currency;
    /**
     * @var float
     */
    private $quotedPrice;

    public function __construct(Currency $currency, $quotedPrice)
    {
        $this->currency = $currency;
        $this->quotedPrice = $quotedPrice;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getQuotedPrice()
    {
        return $this->quotedPrice;
    }
}
