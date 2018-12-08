# back-end-challenge

> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

[![Build Status](https://travis-ci.org/rafaelpv/back-end-challenge.png?branch=rafael-viegas)](https://travis-ci.org/rafaelpv/back-end-challenge)
[![Code Climate](https://codeclimate.com/github/rafaelpv/back-end-challenge/badges/gpa.svg)](https://codeclimate.com/github/rafaelpv/back-end-challenge)
[![Test Coverage](https://codeclimate.com/github/rafaelpv/back-end-challenge/badges/coverage.svg)](https://codeclimate.com/github/rafaelpv/back-end-challenge/code)

## Instru��es para execu��o

#### Depend�ncias

[PHP](http://php.net/downloads.php) 5.6 ou superior (testado nas vers�es 5.6 e 7.0)

[MySQL](https://www.mysql.com/downloads/) testado na vers�o 5.7

[Composer](https://getcomposer.org/)

#### Observa��es gerais

- Fico devendo o Docker, pe�o desculpas. N�o estou conseguindo instalar na minha m�quina por alguma incompatibilidade, acredito que causada por eu ter trabalhado com Vagrant h� um tempo atr�s e ter mexido em configura��es da m�quina virtual. Sendo assim, por n�o ser pr�-requisito, preferi focar o tempo na realiza��o do teste.

- Sei que um dos diferenciais era n�o usar Framework, mas usei o [Lumen](https://lumen.laravel.com/) por dois motivos: o primeiro � que ele � considerado um micro-framework. O segundo, � que o foco dele � justamente o desenvolvimento de APIs, portanto considerei que traria benef�cios principalmente � facilidade de estrutura��o do c�digo, sendo adequado.   

#### Clonar o reposit�rio

Para clonar o reposit�rio, o seguinte comando deve ser executado:

```
git clone https://github.com/rafaelpv/back-end-challenge.git
```

Logo ap�s, � necess�rio entrar no diret�rio do projeto e mudar o branch:

```
cd back-end-challenge
git checkout rafael-viegas
```

#### Gerenciando depend�ncias

Instale as depend�ncias atrav�s do seguinte comando:

```
composer update --no-scripts 
```

#### Configura��o do banco de dados

1- Crie um banco de dados com o nome 'rafael-viegas-challenge' (voc� pode utilizar outro nome, desde que configure corretamente o arquivo '.env', conforme descrito a seguir).

2- Modifique o nome do arquivo '.env.example' para '.env'. Logo ap�s, configure os seguintes itens, de acordo com os dados do seu banco:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rafael-viegas-challenge
DB_USERNAME=root
DB_PASSWORD=
```


#### Criando tabelas do banco de dados e as populando

Execute os seguintes comandos:

```
php artisan migrate
php artisan db:seed
```


#### Executando a API

No terminal, execute o comando a seguir. A porta 8080 deve estar dispon�vel.

```
php artisan serve --port=8080
```

No navegador, acesse o link abaixo. Os par�metros descritos como {from}, {to} e {value} devem receber as entradas descritas no item a seguir.

```
http://localhost:8080/api/v1/from/{from}/to/{to}/value/{value}
```

#### Entradas

A API solicita 3 entradas, com as seguintes op��es dispon�veis:

{from} - Representa a moeda de origem, a qual o valor ser� convertido. Pode receber os valores 'Real', 'Dolar' e 'Euro'. 

{to} - Representa a moeda de destino, para a qual o valor ser� convertido. Pode receber os valores 'Real', 'Dolar' e 'Euro'. 

{value} - Representa o valor que ser� convertido. Deve ser num�rico e positivo.


#### Sa�das

A API gera 2 tipos de sa�das. Quando a opera��o � realizada normalmente, � retornado um array, em formato json, contendo os �ndices a seguir:

```
value - cont�m o valor convertido, formatado de acordo com a moeda de destino. Exemplo: 5.354,25 (considerando convers�o para Real)

symbol - cont�m o s�mbolo oficial da moeda. Exemplo: R$ (considerando convers�o para Real).

formatted - concatena��o do s�mbolo e do valor convertido. Exemplo: R$ 5.354,25 (considerando convers�o para Real).

Exemplo: {"value":"5.354,25","symbol":"R$","formatted":"R$ 5.354,25"}

```

Quando a opera��o cont�m erro, a sa�da gerada � um array, em formato json, com o �ndice 'error' descrevendo o problema.

```
{"error":"Currency Iene not found!"}
```

#### Exemplos de uso

Entrada com sucesso:
```
http://localhost:8080/api/v1/from/Real/to/Dolar/value/20000
```

Sa�da com sucesso:
```
{"value":"5,167.96","symbol":"US$","formatted":"US$ 5,167.96"}
```

Entrada com erro:
```
http://localhost:8080/api/v1/from/Iene/to/Dolar/value/20000
```

Sa�da com erro:
```
{"error":"Currency Iene not found!"}
```


## Qualidade de C�digo

Buscando qualidade de c�digo, alguns cuidados foram tomados.

#### Realiza��o de testes

Os testes est�o contidos no diret�rio 'tests'. Podem ser executados atrav�s do seguinte comando:
```
vendor/bin/phpunit tests/
```

#### Adequa��o ao PSR-2 Coding Style

A fun��o principal das normas PSR � formar um padr�o universal de desenvolvimento, de forma que c�digos de diferentes autores possam coexistir entre si sem causar nenhum transtorno. Portanto, foi seguido o padr�o [PSR-2](https://www.php-fig.org/psr/psr-2/). A ferramenta respons�vel por percorrer o c�digo para verifica��o pode ser executada da seguinte forma:

```
vendor/bin/phpcs --standard=psr2 app/
```

#### Identifica��o de c�digo duplicado

Para evitar c�digo duplicado, utilizou-se [PHPCpd](https://github.com/sebastianbergmann/phpcpd). Pode ser verificado com o seguinte comando:
```
vendor/bin/phpcpd --verbose app/
```

#### Boas pr�ticas em geral

Para garantir boas pr�ticas em geral, tais como tamanhos adequados de m�todos, remo��o de c�digo n�o utilizado e padroniza��o de c�digo, foi utilizado o [PHPMD](https://phpmd.org/). Pode ser verificado com o seguinte comando:
```
vendor/bin/phpmd app/ text codesize,unusedcode,naming,design
```

#### Estat�sticas do c�digo

Para mensurar as estat�sticas do c�digo, foi utilizado o [PHPLOC](https://github.com/sebastianbergmann/phploc). Pode ser verificado com o seguinte comando:
```
vendor/bin/phploc app/
```

#### Travis CI

Todos os testes supracitados foram realizados de forma autom�tica, para as vers�es de PHP 5.6 e 7.0, com a ferramenta [Travis CI](https://travis-ci.org/rafaelpv/back-end-challenge).

#### Code Climate

Atrav�s do Code Climate, � poss�vel garantir que o c�digo possui bons padr�es, bem como checar alguns poss�veis problemas apontados por ele. Uma das ferramentas interessantes � o [Test Coverage, que indica a cobertura dos testes sobre o c�digo](https://codeclimate.com/github/rafaelpv/back-end-challenge/code). � importante frisar que arquivos sem linhas de c�digos relevantes foram removidos da an�lise.


