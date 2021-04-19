
## Utilização da API:

- 1o parametro: de      = Sigla da moeda do valor informado
- 2o parametro: para    = Sigla da moeda para conversão
- 3o parametro: valor   = Valor a ser convertivo
- 4o parametro: cotacao = Valor da cotacao
- 5o parametro: tipo    = *OPCIONAL - Caso setado "api" busca o valor da cotação via API

* As cotações de cada uma das moedas são consultadas via API no serviço https://economia.awesomeapi.com.br/

Siglas aceitas pela API: BRL, USD ou EUR

## Exemplos de utilização:

Ambiente de Desenvolvimento
Cotação via parametro
http://localhost/back-end-challenge/?de=BRL&para=EUR&valor=2071.90&cotacao=5.75
Cotação via API
http://localhost/back-end-challenge/api.php?de=BRL&para=EUR&valor=2071.90&tipo=api

Ambiente de Produção
http://personare.com.br/api/?de=BRL&para=EUR&valor=2071.90&cotacao=5.75
http://personare.com.br/api/api.php?de=BRL&para=EUR&valor=2071.90&tipo=api

Retorno:

{
  "resultado": "309.54",
  "simbolo": "€"
}

## Configuração:

1) Alterar o path do caminho real nos arquivos de testes (/tests/) na linha 4 de cada arquivo do PHPUnit e linha 2 dos arquivos index.php e api.php

include("/Users/orbitive/www/back-end-challenge/autoload.php");

2) Realizar a instalação do PHPUnit, PHPDocs, Node.js com o módulo "request"


# Requisitos

PHPUnit, PHPDocs e Node.js com módulo request

-------------------------------------------

## PHPUnit
Instalação
https://phpunit.readthedocs.io/pt_BR/latest/installation.html

Testes Unitários

Classes: API, Conversão, Cotação e Moedas

Para o teste ConversaoAPITest.php, esta sendo utilizado a cotação do dia 15/04/2021 de acordo com as consultas dos links descritos nos comentários da classeTest

PHP
- ./vendor/bin/phpunit tests/APITest.php
- ./vendor/bin/phpunit tests/ConversaoTest.php
- ./vendor/bin/phpunit tests/ConversaoAPITest.php
- ./vendor/bin/phpunit tests/CotacaoTest.php
- ./vendor/bin/phpunit tests/MoedaTest.php

-------------------------------------------

## PHPDocs

Instalação
https://docs.phpdoc.org/3.0/guide/getting-started/installing.html

Documentação da API disponível em:

Ambiente de Desenvolvimento
http://localhost/back-end-challenge/docs/

Ambiente de Produção
http://personare.com.br/api/docs/

-------------------------------------------

## Node.js 
https://nodejs.org/en/download/

Teste Unitário para leitura da API via Node.js

- npm install request
- node tests/JSONTest.js

-------------------------------------------















# back-end-challenge

> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

## Introdução

A nossa Product Owner pensou em um produto fantástico para ser desenvolvido, porém é necessário realizar uma conversão de moedas para que tudo funcione perfeitamente e essa é a única feature que está faltando para entregarmos o projeto.

**Então, essa é a sua missão!**

É isso mesmo, você deverá criar uma API que realize conversão de moedas. 

E as especificações são:

- A requisição deve receber a cotação via parâmetro
- A resposta deve conter o valor convertido e o símbolo da moeda
- Conversões:
    - De Real para Dólar
    - De Dólar para Real
    - De Real para Euro
    - De Euro para Real

## Instruções

1. Efetue o **fork** deste repositório e crie um branch com o seu nome. (ex: caue-alves).
2. Após finalizar o desafio, crie um **Pull Request**.
3. Aguarde algum contribuidor realizar o code review.

## Pré-requisitos

- Você pode usar a linguagem que preferir. (Preferência para PHP >= 5.6, Javascript ou Python)
- Orientado a objetos
- Test Driven Development
- A API deve retornar em formato de `json`

## Diferenciais

- S.O.L.I.D
- Boa documentação
- Não utilizar framework
- Utilização de DDD (Domain Driven Design)
- Implementar integração contínua

## Dúvidas

Se surgir alguma dúvida, consulte as [perguntas feitas anteriormente](https://github.com/Personare/back-end-challenge/labels/question).

Caso não encontre a sua resposta, sinta-se à vontade para [abrir uma issue](https://github.com/Personare/back-end-challenge/issues/new) =]
