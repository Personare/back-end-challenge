<?php
namespace CoinConversion;

use CoinConversion\Currency\BrlCurrency;
use CoinConversion\Currency\UsdCurrency;
use CoinConversion\Environment\LocalEnvironment;
use CoinConversion\Quotation\QuotationFixture;
use GuzzleHttp\Client;

class CoinConversionControllerTest extends \PHPUnit_Framework_TestCase
{
    /** @var Environment $environment */
    private static $environment;
    /** @var  QuotationFixture $quotationFixture */
    private static $quotationFixture;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$environment = new LocalEnvironment();
        self::$quotationFixture = new QuotationFixture(self::$environment);
    }

    /**
     * Setup for every test.
     */
    protected function setUp()
    {
        self::$quotationFixture->reload();
    }

    /**
     * @group integration-test
     */
    public function testConvertFromBrlToUsdCurrency()
    {
        // setup
        $from = new BrlCurrency();
        $to = new UsdCurrency();
        $value = 3.21529968;
        $expectedValue = 1;
        $environment = self::$environment;
        self::$quotationFixture->insert($from, $to, 0.311013);

        // execution
        $client = new Client();
        $response = $client->get("{$environment->get('PERSONARE_URL')}?from={$from->getId()}&to={$to->getId()}&value={$value}");

        // assertions
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('application/json', $response->getHeader('content-type'));

        $body = \GuzzleHttp\json_decode($response->getBody());
        $this->assertEquals($expectedValue, $body->currency->value, "", 0.1);
        $this->assertEquals($to->getSymbol(), $body->currency->symbol);
    }
}
