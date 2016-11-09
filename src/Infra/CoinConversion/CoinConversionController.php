<?php
namespace CoinConversion;

use CoinConversion\Currency\CurrencyFactory;
use CoinConversion\Currency\CurrencyQuote;

class CoinConversionController
{
    /** @var  CoinConversionController */
    private static $instance = null;
    /** @var  CoinConversionBO */
    private $coinConversionBO;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->coinConversionBO = CoinConversionBOFactory::build();
    }

    /**
     * @param array $parameters
     * @return string
     */
    public function doConversion(array $parameters)
    {
        /** @var CurrencyQuote $currencyQuote */
        $currencyQuote = $this->coinConversionBO->convert(
            CurrencyFactory::build($parameters['from']),
            CurrencyFactory::build($parameters['to']),
            $parameters['value']
        );
        $payload = [
            'currency' => [
                'value' => $currencyQuote->getQuotedPrice(),
                'symbol' => $currencyQuote->getCurrency()->getSymbol()
            ]
        ];

        header('Content-Type: application/json');
        return \GuzzleHttp\json_encode($payload);
    }
}
