<?php
namespace CoinConversion;

use CoinConversion\Currency\BrlCurrency;
use CoinConversion\Currency\Currency;
use CoinConversion\Currency\CurrencyQuote;
use CoinConversion\Currency\EurCurrency;
use CoinConversion\Currency\UsdCurrency;
use CoinConversion\Quotation\Quotation;
use CoinConversion\Quotation\QuotationDS;
use PHPUnit\Framework\TestCase;

class CoinConversionBOTest extends TestCase
{
    public function testConvertOneBrlCurrencyToUsdCurrency()
    {
        // setup
        $from = new BrlCurrency();
        $to = new UsdCurrency();
        $value = 1;
        $quotationValue = $expectedValue = 0.315313;
        $expectedSymbol = '$';
        $coinConversionDS = $this->getCoinConversionDSMocked($from, $to, $quotationValue);

        // execution
        $coinConversionBO = new CoinConversionBO($coinConversionDS);
        $currencyQuote = $coinConversionBO->convert($from, $to, $value);

        // assertions
        $this->assertCurrencyQuote($currencyQuote, $expectedValue, $expectedSymbol);
    }

    public function testConvertTwoBrlCurrencyToUsdCurrency()
    {
        // setup
        $from = new BrlCurrency();
        $to = new UsdCurrency();
        $valueToQuote = 2;
        $quotationValue = 0.315313;
        $expectedValue = $quotationValue * $valueToQuote; // 0.630626
        $expectedSymbol = '$';
        $coinConversionDS = $this->getCoinConversionDSMocked($from, $to, $quotationValue);

        // execution
        $coinConversionBO = new CoinConversionBO($coinConversionDS);
        $currencyQuote = $coinConversionBO->convert($from, $to, $valueToQuote);

        // assertions
        $this->assertCurrencyQuote($currencyQuote, $expectedValue, $expectedSymbol);
    }

    public function testConvertTwoBrlCurrencyToEurCurrency()
    {
        // setup
        $from = new BrlCurrency();
        $to = new EurCurrency();
        $valueToQuote = 2;
        $quotationValue = 0.284056078;
        $expectedValue = $quotationValue * $valueToQuote; // 0.567238792
        $expectedSymbol = '€';
        $coinConversionDS = $this->getCoinConversionDSMocked($from, $to, $quotationValue);

        // execution
        $coinConversionBO = new CoinConversionBO($coinConversionDS);
        $currencyQuote = $coinConversionBO->convert($from, $to, $valueToQuote);

        // assertions
        $this->assertCurrencyQuote($currencyQuote, $expectedValue, $expectedSymbol);
    }

    /**
     * @param mixed $currencyQuote
     * @param float $expectedValue
     * @param string $expectedSymbol
     */
    public function assertCurrencyQuote($currencyQuote, $expectedValue, $expectedSymbol)
    {
        $this->assertInstanceOf(CurrencyQuote::class, $currencyQuote);
        $this->assertEquals($expectedValue, $currencyQuote->getQuotedPrice());
        $this->assertEquals($expectedSymbol, $currencyQuote->getCurrency()->getSymbol());
    }

    /**
     * @param Currency $from
     * @param Currency $to
     * @param float $quotationValue
     * @return QuotationDS|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getCoinConversionDSMocked(Currency $from, Currency $to, $quotationValue)
    {
        /** @var QuotationDS|\PHPUnit_Framework_MockObject_MockObject $coinConversionDS */
        $coinConversionDS = $this->createMock(QuotationDS::class);
        $coinConversionDS->expects($this->any())
            ->method('getQuotation')
            ->with($this->equalTo($from), $this->equalTo($to))
            ->will($this->returnValue(new Quotation($from, $to, $quotationValue)));
        return $coinConversionDS;
    }
}
