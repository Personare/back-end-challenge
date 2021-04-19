<?php
use PHPUnit\Framework\TestCase;

include("/Users/orbitive/www/back-end-challenge/autoload.php");

class ConversaoAPITest extends TestCase {

    private $conversao;
    private $moeda;

    public function testConverter() {

        /*
         * Consulte a API abaixo para verificar a cotação do dia dos testes realizados
         * para cada moeda e comparar com os valores gerados pelo sistema. (valor "ask")
         * https://economia.awesomeapi.com.br/json/daily/BRL-USD/?start_date=20210415
         * https://economia.awesomeapi.com.br/json/daily/USD-BRL/?start_date=20210415
         * https://economia.awesomeapi.com.br/json/daily/BRL-EUR/?start_date=20210415
         * https://economia.awesomeapi.com.br/json/daily/EUR-BRL/?start_date=20210415
         */

        ////////////////////
        // De Real para Dólar
        // https://economia.awesomeapi.com.br/json/daily/BRL-USD/?start_date=20210415
        $this->moeda        = new Moeda("BRL", "USD");
        $this->conversao    = new Conversao("BRL", "USD", 2071.90, 0, "api");

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 0.1795),
            "simbolo" => "U$"
        ];

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->converter(), json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);
        
        ////////////////////
        // De Dólar para Real
        // https://economia.awesomeapi.com.br/json/daily/USD-BRL/?start_date=20210415
        $this->moeda        = new Moeda("USD","BRL");
        $this->conversao    = new Conversao("USD","BRL",2071.90, 0, "api");

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 5.6771),
            "simbolo" => "R$"
        ];

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->converter(),
                json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);
        
        ////////////////////
        // De Real para Euro
        // https://economia.awesomeapi.com.br/json/daily/BRL-EUR/?start_date=20210415
        $this->moeda        = new Moeda("BRL","EUR");
        $this->conversao    = new Conversao("BRL","EUR", 2071.90, 0, "api");

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 0.1479),
            "simbolo" => "€"
        ];

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->converter(),
                json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);

        // De Euro para Real
        // https://economia.awesomeapi.com.br/json/daily/EUR-BRL/?start_date=20210415
        $this->moeda        = new Moeda("EUR","BRL");
        $this->conversao    = new Conversao("EUR","BRL", 2071.90, 0, "api");

        $array = [
            "resultado" => $this->moeda->formatarNumero(2071.90 * 6.8404),
            "simbolo" => "R$"
        ];

        $this->assertJsonStringEqualsJsonString(
                $this->conversao->converter(),
                json_encode($array)
        );

        unset($this->conversao);
        unset($this->moeda);
        unset($valor);
        unset($array);

    }
    
}
?>
