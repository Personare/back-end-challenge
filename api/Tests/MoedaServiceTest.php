<?php
require_once dirname(__FILE__).'/../../vendor/autoload.php';
require_once dirname(__FILE__).'/../Application/MoedaAppService.php';

use PHPUnit\Framework\TestCase;

class MoedaServiceTest extends TestCase {
    public MoedaAppService $realAppService;
    public MoedaAppService $dolarAppService;
    public MoedaAppService $euroAppService;

    protected function setUp() : void
    {
        $this->realAppService = new MoedaAppService("real");
        $this->dolarAppService = new MoedaAppService("dolar");
        $this->euroAppService = new MoedaAppService("euro");
    }

    public function testSimbolo()
    {
        $this->assertEquals("R$", $this->realAppService->getSimbolo());
        $this->assertEquals("US$", $this->dolarAppService->getSimbolo());
        $this->assertEquals("€", $this->euroAppService->getSimbolo());
    }

    public function testConverter()
    {
        $this->assertEquals(1104, $this->dolarAppService->converter(200, 5.52));
    }
}
