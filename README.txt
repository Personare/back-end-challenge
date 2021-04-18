
Utilização da API:

1o parametro: de    = Sigla da moeda do valor informado
2o parametro: para  = Sigla da moeda para conversão
3o parametro: valor = Valor a ser convertivo

Siglas aceitas pela API: BRL, USD ou EUR

Exemplos de utilização:

Ambiente de Desenvolvimento
http://localhost/back-end-challenge/?de=BRL&para=EUR&valor=2071.90

Ambiente de Produção
http://personare.com.br/api/?de=BRL&para=EUR&valor=2071.90

Retorno:

{
  "resultado": "309.54",
  "simbolo": "€"
}

Configuração:

1) Alterar o path do caminho real nos arquivos de testes na linha 4 de cada arquivo do PHPUnit

include("/Users/orbitive/www/back-end-challenge/autoload.php");

2) Realizar a instalação do PHPUnit, PHPDocs, Node.js com o módulo "request"



Requisitos

# PHPUnit
# PHPDocs
# Node.js com módulo request

-------------------------------------------

>> PHPUnit <<
Instalação
https://phpunit.readthedocs.io/pt_BR/latest/installation.html

Testes Unitários

Classes: API, Conversão, Cotação e Moedas

PHP
# ./vendor/bin/phpunit tests/APITest.php
# ./vendor/bin/phpunit tests/ConversaoTest.php
# ./vendor/bin/phpunit tests/CotacaoTest.php
# ./vendor/bin/phpunit tests/MoedaTest.php

-------------------------------------------

>> PHPDocs <<

Instalação
https://docs.phpdoc.org/3.0/guide/getting-started/installing.html

Documentação da API disponível em:

Ambiente de Desenvolvimento
http://localhost/back-end-challenge/docs/

Ambiente de Produção
http://personare.com.br/api/docs/

-------------------------------------------

>> Node.js <<
https://nodejs.org/en/download/

Teste Unitário para leitura da API via Node.js

# npm install request
# node tests/JSONTest.js

-------------------------------------------









