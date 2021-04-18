<?php
use PHPUnit\Framework\TestCase;

include("/Users/orbitive/www/back-end-challenge/autoload.php");

class MoedaTest extends TestCase {

    private $moeda;

    public function testRetornarSimbolo() {

        $this->moeda = new Moeda("BRL", "USD");
        
        // De Real para Dólar
        $this->assertEquals($this->moeda->retornarSimbolo(), "U$");

        // De Dólar para Real
        $this->moeda->setMoedaEntrada("USD");
        $this->moeda->setMoedaSaida("BRL");
        $this->assertEquals($this->moeda->retornarSimbolo(),"R$");
        
        // De Real para Euro
        $this->moeda->setMoedaEntrada("BRL");
        $this->moeda->setMoedaSaida("EUR");
        $this->assertEquals($this->moeda->retornarSimbolo(),"€");
        
        // De Euro para Real
        $this->moeda->setMoedaEntrada("EUR","BRL");
        $this->moeda->setMoedaSaida("BRL");
        $this->assertEquals($this->moeda->retornarSimbolo(),"R$");
    }

}

?>
