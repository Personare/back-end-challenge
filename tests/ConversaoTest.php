<?php
use PHPUnit\Framework\TestCase;

include("/Users/orbitive/www/back-end-challenge/autoload.php");

class ConversaoTest extends TestCase {

    private $conversao;
    private $moeda;

    public function testConverter() {

        /*
          Consulte a API abaixo para verificar a cotação do dia dos testes realizados
          para cada moeda e comparar com os valores gerados pelo sistema.
          https://economia.awesomeapi.com.br/EUR-BRL/1
         */
        
        ////////////////////
        // De Real para Dólar
        $this->moeda        = new Moeda("BRL", "USD");
        $this->conversao    = new Conversao("BRL", "USD", 2071.90);

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 0.179),
            "simbolo" => "U$"
        ];
        
        //var_dump($this->conversao->json());

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->json(), json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);
        
        ////////////////////
        // De Dólar para Real
        $this->moeda        = new Moeda("USD","BRL");
        $this->conversao    = new Conversao("USD","BRL",2071.90);

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 5.5873),
            "simbolo" => "R$"
        ];
        
        //var_dump($this->conversao->json());

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->json(),
                json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);
        
        ////////////////////
        // De Real para Euro
        $this->moeda        = new Moeda("BRL","EUR");
        $this->conversao    = new Conversao("BRL","EUR",2071.90);

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 0.1494),
            "simbolo" => "€"
        ];
        
        //var_dump($this->conversao->json());

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->json(),
                json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);

        // De Euro para Real
        $this->moeda        = new Moeda("EUR","BRL");
        $this->conversao    = new Conversao("EUR","BRL",2071.90);

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 6.6993),
            "simbolo" => "R$"
        ];
        
        //var_dump($this->conversao->json());

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->json(),
                json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);

    }
    
}
?>
