<?php

declare(strict_types=1);

namespace CurrencyConverter;

//Criando a classe de calculo das moedas.
class Calculator
{
    private $rates; //Variavel que vai receber a cotação.
    private $symbols; //Variavel que vai receber o Simbolo.
    private $from; //Variavel que vai receber o primeiro a moeda a ser convertida.
    private $to; //Variavel que vai receber a moeda de conversão.
    private $value; //Variavel que vai receber a saida, a moeda ja convertida.

    //Criando a função de construção para chamar as funções de carregamento de cotação e de simbolo que são privadas.
    public function __construct()
    {
        $this->loadRates();
        $this->loadSymbols();
    }

    //Criando a Função de carregamento das cotações do arquivo rates.json.
    private function loadRates(): void
    {
        $this->rates = json_decode(file_get_contents(RATES_PATH), true);
    }

    //Criando a função de carregamento dos simbolos do arquivo symbols.json.
    private function loadSymbols(): void
    {
        $this->symbols = json_decode(file_get_contents(SYMBOLS_PATH), true);
    }

    //Cirando a função de calculo que vai ter como parametro 3 variaveis, que vai receber as moedas e o valor de saida.
    public function calculate($from, $to, $value): array
    {
        $this->setParams($from, $to, $value);

        $rate = $this->getRate();

        $original_value = $this->format($this->value);
        $converted_value = $this->format($this->value * $rate);

        $conversion['original_value'] = "{$this->getSymbol($this->from)} $original_value";
        $conversion['converted_value'] = "{$this->getSymbol($this->to)} $converted_value";
        $conversion['rate'] = $this->format($rate);

        return $conversion;
    }

    //Criando a Função de configuração dos paramentros.
    private function setParams($from, $to, $value)
    {
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
    }

    //Criando a função para obter e verificar se a moeda existe dentro do arquivo rates.json.
    private function getRate(): float
    {
        if (array_key_exists($this->from, $this->rates)) {
            if (array_key_exists($this->to, $this->rates[$this->from])) {
                return floatval($this->rates[$this->from][$this->to]);
            }
        }

        throw new RateNotFoundException('Essa API apenas tem 3 moedas, quer mais? da um google'); //Caso a moeda não exista, sera mostrado esse erro. ^^/
    }

    //Criando a função de formatação do valor de saida.
    private function format($value): string
    {
        return number_format($value, 2);
    }

    //Criando a função para obter e verificar se o simbolo existe dentro do arquivo symbols.json.
    private function getSymbol($currency): string
    {
        if (array_key_exists($currency, $this->symbols)) {
            return $this->symbols[$currency];
        }

        throw new SymbolNotFoundException("Não tem simbolo para essa moeda....'{$currency}'.");
    }
}

class RateNotFoundException extends \Exception
{
}

class SymbolNotFoundException extends \Exception
{
}
