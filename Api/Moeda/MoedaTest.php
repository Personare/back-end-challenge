<?php
use Api\Cotacao\Cotacao;
use Api\Moeda\Moeda;

require_once 'Api/Moeda/MoedaInterface.php';
require_once 'Api/Cotacao/Cotacao.php';
require_once 'Api/Moeda/Moeda.php';


/**
 * Moeda test case.
 */
class MoedaTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Moeda
     */
    private $moeda;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated MoedaTest::setUp()
      //  $this->expectException(InvalidArgumentException::class);
        $this->moeda = new Moeda(new Cotacao());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated MoedaTest::tearDown()
        $this->moeda = null;
        
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
     * Tests Moeda->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated MoedaTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");

    }

    
    /**
     * 
     */
    public function testSetMoedaSaida()
    {
        // TODO Auto-generated MoedaTest->testSetMoedaSaida()
     //  $this->markTestIncomplete("setMoedaSaida test not implemented");
        
        
        $this->assertNull($this->moeda->setMoedaSaida('BRL'));
        $this->assertNull($this->moeda->setMoedaSaida('USD'));
        $this->assertNull($this->moeda->setMoedaSaida('EUR'));
        
        try {
            $this->moeda->setMoedaSaida('');
        }catch (InvalidArgumentException $expected) {
            return;
        }
        
        try {
            $this->moeda->setMoedaSaida('nao existe');
        }catch (InvalidArgumentException $expected) {
            return;
        }
        
    }

    /**
     * Tests Moeda->setMoedaEntrada()
     */
    public function testSetMoedaEntrada()
    {
        // TODO Auto-generated MoedaTest->testSetMoedaEntrada()
       // $this->markTestIncomplete("setMoedaEntrada test not implemented");
        
        $this->assertNull($this->moeda->setMoedaEntrada('BRL'));
        $this->assertNull($this->moeda->setMoedaEntrada('USD'));
        $this->assertNull($this->moeda->setMoedaEntrada('EUR'));
        
        try {
            $this->moeda->setMoedaEntrada('');
        }catch (InvalidArgumentException $expected) {
          //  echo $expected;
            $this->assertEquals('entrada: Este tipo não é válido use somente USD, EUR ou BRL', $expected->getMessage());
        }
        
        try {
            $this->moeda->setMoedaEntrada('nao existe');
        }catch (InvalidArgumentException $expected) {
            $this->assertEquals('entrada: Este tipo não é válido use somente USD, EUR ou BRL', $expected->getMessage());
        }
    }

    
    
    /**
     * Tests Moeda->validaMoeda()
     * @dataProvider additionProvider
     */
    public function testValidaMoeda()
    {
        // TODO Auto-generated MoedaTest->testValidaMoeda()
        
        $this->assertEquals(true, $this->moeda->validaMoeda('BRL'));
        $this->assertEquals(true, $this->moeda->validaMoeda('USD'));
        $this->assertEquals(true, $this->moeda->validaMoeda('EUR'));
        $this->assertEquals(false, $this->moeda->validaMoeda(''));
        $this->assertEquals(false, $this->moeda->validaMoeda('NAO EXISTE'));
        
    }

    /**
     * Tests Moeda->converte()
     */
    public function testConverte()
    {
        
        //testa retorno de array
        $this->moeda->setMoedaEntrada('BRL');
        $this->moeda->setMoedaSaida('USD');
        
        $this->assertArrayHasKey('simbolo', $this->moeda->converte(50)); //testa se existe chave
        $this->assertArrayHasKey('Valor', $this->moeda->converte(50));//testa se existe chave
        
        
        //testa símbolos
        $retorno = $this->moeda->converte(50); //pega retorno array
        $this->assertEquals("$", $retorno['simbolo']); //retorna dolar
        
        $this->moeda->setMoedaSaida('EUR');
        $retorno = $this->moeda->converte(50); //pega retorno array
        $this->assertEquals("&#8364;", $retorno['simbolo']); //retorna euro
        
        $this->moeda->setMoedaEntrada('USD');
        $this->moeda->setMoedaSaida('BRL');
        $retorno = $this->moeda->converte(50); //pega retorno array
        $this->assertEquals('R$', $retorno['simbolo']); //retorna real
        
        //testa tipos de conversao nao suportados
        $this->moeda->setMoedaEntrada('EUR');
        $this->moeda->setMoedaSaida('USD');
        
        try {
            $this->moeda->converte(50); //pega retorno array
        }catch (InvalidArgumentException $expected) {
            $this->assertEquals('Esta conversão não é suportada', $expected->getMessage());
        }
        
        $this->moeda->setMoedaEntrada('USD');
        $this->moeda->setMoedaSaida('EUR');
        
        try {
            $this->moeda->converte(50); //pega retorno array
        }catch (InvalidArgumentException $expected) {
            $this->assertEquals('Esta conversão não é suportada', $expected->getMessage());
        }
        
        $this->moeda->setMoedaEntrada('BRL');
        $this->moeda->setMoedaSaida('BRL');
        
        try {
            $this->moeda->converte(50); //pega retorno array
        }catch (InvalidArgumentException $expected) {
            $this->assertEquals('Esta conversão não é suportada', $expected->getMessage());
        }
        
        
        
    }
}

