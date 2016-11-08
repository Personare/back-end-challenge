<?php
namespace CoinConversion;

use CoinConversion\Currency\BrlCurrency;
use CoinConversion\Currency\UsdCurrency;
use CoinConversion\Quotation\Quotation;
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

        $quotation = new Quotation($from, $to, $quotationValue);

        /** @var CoinConversionDS|\PHPUnit_Framework_MockObject_MockObject $coinConversionDS */
        $coinConversionDS = $this->getMockBuilder('\\CoinConversion\\CoinConversionDS')->getMock();
        $coinConversionDS->method('getQuotation')
            ->with($this->equalTo($from), $this->equalTo($to))
            ->will($this->returnValue($quotation));

        // execution
        $coinConversionBO = new CoinConversionBO($coinConversionDS);
        $convertedValue = $coinConversionBO->convert($from, $to, $value);

        // assertions
        $this->assertEquals($expectedValue, $convertedValue);
    }

    public function testConvertTwoBrlCurrencyToUsdCurrency()
    {
        // setup
        $from = new BrlCurrency();
        $to = new UsdCurrency();
        $value = 2;
        $quotationValue = 0.315313;
        $expectedValue = $quotationValue * $value;

        $quotation = new Quotation($from, $to, $quotationValue);

        /** @var CoinConversionDS|\PHPUnit_Framework_MockObject_MockObject $coinConversionDS */
        $coinConversionDS = $this->getMockBuilder('\\CoinConversion\\CoinConversionDS')->getMock();
        $coinConversionDS->method('getQuotation')
            ->with($this->equalTo($from), $this->equalTo($to))
            ->will($this->returnValue($quotation));

        // execution
        $coinConversionBO = new CoinConversionBO($coinConversionDS);
        $convertedValue = $coinConversionBO->convert($from, $to, $value);

        // assertions
        $this->assertEquals($expectedValue, $convertedValue);
    }
}
