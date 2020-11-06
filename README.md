# back-end-challenge

Documentação para o projeto back-end-challenge. 

## Introdução

Esse projeto se trata de uma API para conversão de moedas, em resposta ao desafio proposto para novos desenvolvedores.
Foi desenvolvido basicamente em puro PHP, utilizando a biblioteca [PHPUnit](https://phpunit.de/) para a execução de testes unitários.
Foram utilizados os conceitos de OO, SOLID, TDD, DDD e integração contínua. 

## Instruções

Para executar o serviço, basta executar o seguinte comando no diretório raiz para criar e rodar um container Docker:

`docker-compose up -d`

Obs: [Docker](https://www.docker.com/get-started) e [docker-compose](https://docs.docker.com/compose/install/) são pré-requisitos.

## API

Url do serviço:

`http://localhost:803/convertemoeda.php` 

Parâmetros:

`moeda`   => Moeda destino para a conversão. Valores válidos: "real", "dolar", "euro";
`valor`   => Valor a ser convertido. Deve ser numérico.
`cotacao` => Cotação da conversão. Deve ser numérico.

Exemplo de solicitação:

`http://localhost:803/convertemoeda.php?moeda=euro&valor=200&cotacao=5.52`

Resposta json:

`{"símbolo":"€","resultado":1104}`

## Integração Contínua

Foi criado um workflow no GitHub Actions para executar os testes unitários automaticamente.
Para visualizar o resultado do workflow, ir em Actions e selecionar o workflow "PHP Composer".   