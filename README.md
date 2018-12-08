# back-end-challenge

> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

[![Build Status](https://travis-ci.org/rafaelpv/back-end-challenge.png?branch=rafael-viegas)](https://travis-ci.org/rafaelpv/back-end-challenge)
[![Code Climate](https://codeclimate.com/github/rafaelpv/back-end-challenge/badges/gpa.svg)](https://codeclimate.com/github/rafaelpv/back-end-challenge)
[![Test Coverage](https://codeclimate.com/github/rafaelpv/back-end-challenge/badges/coverage.svg)](https://codeclimate.com/github/rafaelpv/back-end-challenge/code)

## Instruções para execução

#### Dependências

[PHP](http://php.net/downloads.php) 5.6 ou superior (testado nas versões 5.6 e 7.0)

[MySQL](https://www.mysql.com/downloads/) testado na versão 5.7

[Composer](https://getcomposer.org/)

#### Observações gerais

- Fico devendo o Docker, peço desculpas. Não estou conseguindo instalar na minha máquina por alguma incompatibilidade, acredito que causada por eu ter trabalhado com Vagrant há um tempo atrás e ter mexido em configurações da máquina virtual. Sendo assim, por não ser pré-requisito, preferi focar o tempo na realização do teste.

- Sei que um dos diferenciais era não usar Framework, mas usei o [Lumen](https://lumen.laravel.com/) por dois motivos: o primeiro é que ele é considerado um micro-framework. O segundo, é que o foco dele é justamente o desenvolvimento de APIs, portanto considerei que traria benefícios principalmente à facilidade de estruturação do código, sendo adequado.   

#### Clonar o repositório

Para clonar o repositório, o seguinte comando deve ser executado:

```
git clone https://github.com/rafaelpv/back-end-challenge.git
```

Logo após, é necessário entrar no diretório do projeto e mudar o branch:

```
cd back-end-challenge
git checkout rafael-viegas
```

#### Gerenciando dependências

Instale as dependências através do seguinte comando:

```
composer update --no-scripts 
```

#### Configuração do banco de dados

1- Crie um banco de dados com o nome 'rafael-viegas-challenge' (você pode utilizar outro nome, desde que configure corretamente o arquivo '.env', conforme descrito a seguir).

2- Modifique o nome do arquivo '.env.example' para '.env'. Logo após, configure os seguintes itens, de acordo com os dados do seu banco:

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

No terminal, execute o comando a seguir. A porta 8080 deve estar disponível.

```
php artisan serve --port=8080
```

No navegador, acesse o link abaixo. Os parâmetros descritos como {from}, {to} e {value} devem receber as entradas descritas no item a seguir.

```
http://localhost:8080/api/v1/from/{from}/to/{to}/value/{value}
```

#### Entradas

A API solicita 3 entradas, com as seguintes opções disponíveis:

{from} - Representa a moeda de origem, a qual o valor será convertido. Pode receber os valores 'Real', 'Dolar' e 'Euro'. 

{to} - Representa a moeda de destino, para a qual o valor será convertido. Pode receber os valores 'Real', 'Dolar' e 'Euro'. 

{value} - Representa o valor que será convertido. Deve ser numérico e positivo.


#### Saídas

A API gera 2 tipos de saídas. Quando a operação é realizada normalmente, é retornado um array, em formato json, contendo os índices a seguir:

```
value - contém o valor convertido, formatado de acordo com a moeda de destino. Exemplo: 5.354,25 (considerando conversão para Real)

symbol - contém o símbolo oficial da moeda. Exemplo: R$ (considerando conversão para Real).

formatted - concatenação do símbolo e do valor convertido. Exemplo: R$ 5.354,25 (considerando conversão para Real).

Exemplo: {"value":"5.354,25","symbol":"R$","formatted":"R$ 5.354,25"}

```

Quando a operação contém erro, a saída gerada é um array, em formato json, com o índice 'error' descrevendo o problema.

```
{"error":"Currency Iene not found!"}
```

#### Exemplos de uso

Entrada com sucesso:
```
http://localhost:8080/api/v1/from/Real/to/Dolar/value/20000
```

Saída com sucesso:
```
{"value":"5,167.96","symbol":"US$","formatted":"US$ 5,167.96"}
```

Entrada com erro:
```
http://localhost:8080/api/v1/from/Iene/to/Dolar/value/20000
```

Saída com erro:
```
{"error":"Currency Iene not found!"}
```


## Qualidade de Código

Buscando qualidade de código, alguns cuidados foram tomados.

#### Realização de testes

Os testes estão contidos no diretório 'tests'. Podem ser executados através do seguinte comando:
```
vendor/bin/phpunit tests/
```

#### Adequação ao PSR-2 Coding Style

A função principal das normas PSR é formar um padrão universal de desenvolvimento, de forma que códigos de diferentes autores possam coexistir entre si sem causar nenhum transtorno. Portanto, foi seguido o padrão [PSR-2](https://www.php-fig.org/psr/psr-2/). A ferramenta responsável por percorrer o código para verificação pode ser executada da seguinte forma:

```
vendor/bin/phpcs --standard=psr2 app/
```

#### Identificação de código duplicado

Para evitar código duplicado, utilizou-se [PHPCpd](https://github.com/sebastianbergmann/phpcpd). Pode ser verificado com o seguinte comando:
```
vendor/bin/phpcpd --verbose app/
```

#### Boas práticas em geral

Para garantir boas práticas em geral, tais como tamanhos adequados de métodos, remoção de código não utilizado e padronização de código, foi utilizado o [PHPMD](https://phpmd.org/). Pode ser verificado com o seguinte comando:
```
vendor/bin/phpmd app/ text codesize,unusedcode,naming,design
```

#### Estatísticas do código

Para mensurar as estatísticas do código, foi utilizado o [PHPLOC](https://github.com/sebastianbergmann/phploc). Pode ser verificado com o seguinte comando:
```
vendor/bin/phploc app/
```

#### Travis CI

Todos os testes supracitados foram realizados de forma automática, para as versões de PHP 5.6 e 7.0, com a ferramenta [Travis CI](https://travis-ci.org/rafaelpv/back-end-challenge).

#### Code Climate

Através do Code Climate, é possível garantir que o código possui bons padrões, bem como checar alguns possíveis problemas apontados por ele. Uma das ferramentas interessantes é o [Test Coverage, que indica a cobertura dos testes sobre o código](https://codeclimate.com/github/rafaelpv/back-end-challenge/code). É importante frisar que arquivos sem linhas de códigos relevantes foram removidos da análise.


