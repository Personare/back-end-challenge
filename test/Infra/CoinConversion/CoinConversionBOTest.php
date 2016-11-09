<?php
namespace CoinConversion;

use CoinConversion\Currency\BrlCurrency;
use CoinConversion\Currency\CurrencyQuote;
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

        $quotation = new Quotation($from, $to, $quotationValue);

        /** @var QuotationDS|\PHPUnit_Framework_MockObject_MockObject $coinConversionDS */
        $coinConversionDS = $this->createMock(QuotationDS::class);
        $coinConversionDS->expects($this->any())
            ->method('getQuotation')
            ->with($this->equalTo($from), $this->equalTo($to))
            ->will($this->returnValue($quotation));

        // execution
        $coinConversionBO = new CoinConversionBO($coinConversionDS);
        $currencyQuote = $coinConversionBO->convert($from, $to, $value);

        // assertions
        $this->assertInstanceOf(CurrencyQuote::class, $currencyQuote);
        $this->assertEquals($expectedValue, $currencyQuote->getQuotedPrice());
        $this->assertEquals($expectedSymbol, $currencyQuote->getCurrency()->getSymbol());
    }

    public function testConvertTwoBrlCurrencyToUsdCurrency()
    {
        // setup
        $from = new BrlCurrency();
        $to = new UsdCurrency();
        $value = 2;
        $quotationValue = 0.315313;
        $expectedValue = $quotationValue * $value;
        $expectedSymbol = '$';

        $quotation = new Quotation($from, $to, $quotationValue);

        /** @var QuotationDS|\PHPUnit_Framework_MockObject_MockObject $coinConversionDS */
        $coinConversionDS = $this->createMock(QuotationDS::class);
        $coinConversionDS->method('getQuotation')
            ->with($this->equalTo($from), $this->equalTo($to))
            ->will($this->returnValue($quotation));

        // execution
        $coinConversionBO = new CoinConversionBO($coinConversionDS);
        $currencyQuote = $coinConversionBO->convert($from, $to, $value);

        // assertions
        $this->assertInstanceOf(CurrencyQuote::class, $currencyQuote);
        $this->assertEquals($expectedValue, $currencyQuote->getQuotedPrice());
        $this->assertEquals($expectedSymbol, $currencyQuote->getCurrency()->getSymbol());
    }
}
