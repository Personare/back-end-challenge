<?php

class ConversorTest extends PHPUnit_Framework_TestCase{
	public function testType(){
		$Conv = new Conversor();
		$this->assertInternalType('float', $Conv->__get());
	}
	
/**
* @depends testType
*/
	
	public function testConverter(){
		$Conv = new Conversor();
		$Conv->valor = 1.5;
        $Conv->cotacao = 2.0;
        $Conv->tipo_de = 'real';
        $Conv->tipo_para = 'dolar';
		$this->assertEquals(3.0, $Conv->converter());
	}
}
?>