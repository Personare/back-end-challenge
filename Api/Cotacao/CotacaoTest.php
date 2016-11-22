<?php
use Api\Cotacao\Cotacao;

require_once 'Api/Cotacao/Cotacao.php';

/**
 * Cotacao test case.
 */
class CotacaoTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Cotacao
     */
    private $cotacao;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated CotacaoTest::setUp()
        
        $this->cotacao = new Cotacao(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated CotacaoTest::tearDown()
        $this->cotacao = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Cotacao->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated CotacaoTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");
        
        $this->cotacao->__construct(/* parameters */);
    }

    /**
     * Tests Cotacao->getDolar()
     */
    public function testGetDolar()
    {

        try {
            $this->cotacao->getDolar(/* parameters */);
        }catch (InvalidArgumentException $expected) {
            return;
        }
        
    }

    /**
     * Tests Cotacao->getEuro()
     */
    public function testGetEuro()
    {
        try {
            $this->cotacao->getEuro(/* parameters */);
        }catch (InvalidArgumentException $expected) {
            return;
        }
        
    }
}

