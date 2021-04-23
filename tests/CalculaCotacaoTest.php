<?php

require __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use \Personare\Helpers\CalculaCotacao;

class CalculaCotacaoTest extends TestCase
{
    protected $valor;

    protected function setUp() :void
    {
        $this->valor = new CalculaCotacao();
    }

    /**
     * @dataProvider arrayCalculoValorProvider
     */
    public function testCalculaValorRetornado($array1, $array2)
    {
        $this->assertEquals($array2, $this->valor->CalculaValor($array1));
    }

    public function arrayCalculoValorProvider()
    {
        return [
            "Teste conta com 1 casa decimal" => [
                [
                    'valor_entrada' => 125.32,
                    'valor_cotacao' => 20,
                ],
                [
                    'valor_entrada' => 125.32,
                    'valor_cotacao' => 20,
                    'valor_final' => 2506.4
                ]
            ],
            "Teste conta com 2 casas decimais" =>[
                [
                    'valor_entrada' => 17.20,
                    'valor_cotacao' => 1.125,
                ],
                [
                    'valor_entrada' => 17.20,
                    'valor_cotacao' => 1.125,
                    'valor_final' => 19.35
                ]
            ]
        ];
    }
}

