<?php

require __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use \GuzzleHttp\Client;

class ApiTest extends TestCase
{
    /**
     * @dataProvider arrayArgumentosGetProvider
     */
    public function testGet($params, $return)
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
            'verify'   => false
        ]);

        $response = $client->get('/'.$params);
        $jsonReturn = json_encode($return);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString($jsonReturn, $response->getBody()->getContents());
    }

    public function arrayArgumentosGetProvider()
    {
        return [
            "Teste de Cotacao USD-BRL" => [
                '?moeda_origem=USD&moeda_destino=BRL&valor=6&cotacao=6',
                [
                    'tipo_cotacao' => "USD-BRL",
                    'valor_entrada' => 6,
                    'valor_cotacao' => 6,
                    'simbolo' => "R$",
                    'valor_final' => 36
                ]
            ],
            "Teste de Cotacao BRL-USD" => [

                '?moeda_origem=BRL&moeda_destino=USD&valor=60&cotacao=0.1',
                [
                    'tipo_cotacao' => "BRL-USD",
                    'valor_entrada' => 60,
                    'valor_cotacao' => 0.1,
                    'simbolo' => "$",
                    'valor_final' => 6
                ]
            ],
            "Teste de Cotacao EUR-BRL" => [
                '?moeda_origem=EUR&moeda_destino=BRL&valor=10.5&cotacao=8.25',
                [
                    'tipo_cotacao' => "EUR-BRL",
                    'valor_entrada' => 10.5,
                    'valor_cotacao' =>8.25,
                    'simbolo' => "R$",
                    'valor_final' => 86.63
                ]
            ],
            "Teste de Cotacao BRL-EUR" => [
                '?moeda_origem=BRL&moeda_destino=EUR&valor=10.5&cotacao=0.125',
                [
                    'tipo_cotacao' => "BRL-EUR",
                    'valor_entrada' => 10.5,
                    'valor_cotacao' => 0.125,
                    'simbolo' => "€",
                    'valor_final' => 1.31
                ]
            ]
        ];
    }
}
