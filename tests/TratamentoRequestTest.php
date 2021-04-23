<?php

require __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use \Personare\Helpers\TratamentoRequest;

class TratamentoRequestTest extends TestCase
{
    protected $request;
    protected $array;

    protected function setUp() :void
    {
        $this->request = new TratamentoRequest();
    }

    /**
     * @dataProvider moedasProvider
     */
    public function testValidacaoDeMoedasCorretas($moeda_origem, $moeda_destino)
    {
        $this->assertTrue($this->request->validaMoeda($moeda_origem, $moeda_destino));
    }

    /**
     * @dataProvider moedasProvider
     */
    public function testValidaParametroCotacao($moeda_origem, $moeda_destino)
    {
        $this->assertTrue($this->request->validaParametroCotacao($moeda_origem, $moeda_destino));
    }

    public function moedasProvider()
    {
        return [
            "Verificacao entrada de Moedas BRL-USD" => ['BRL', 'USD'],
            "Verificacao entrada de Moedas BRL-EUR" => ['BRL', 'EUR'],
            "Verificacao entrada de Moedas USD-BRL" => ['USD', 'BRL'],
            "Verificacao entrada de Moedas EUR-BRL" => ['EUR', 'BRL']
        ];
    }
}

