<?php
use PHPUnit\Framework\TestCase;

include("/Users/orbitive/www/back-end-challenge/autoload.php");

class CotacaoTest extends TestCase {

    private $cotacao;

    public function testCotacaoDiaria() {

        $this->cotacao = new Cotacao();
        
        // De Real para Dólar
        $this->assertGreaterThan(0, $this->cotacao->cotacaoDiaria("BRL","USD"));

        // De Dólar para Real
        $this->assertGreaterThan(0, $this->cotacao->cotacaoDiaria("USD","BRL"));
        
        // De Real para Euro
        $this->assertGreaterThan(0, $this->cotacao->cotacaoDiaria("BRL","EUR"));
        
        // De Euro para Real
        $this->assertGreaterThan(0, $this->cotacao->cotacaoDiaria("EUR","BRL"));
    }

}
?>
