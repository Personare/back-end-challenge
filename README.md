# Api-Exchange

## Introdução

API que realiza a conversão de moedas, recebendo como a moeda origem, moeda destino, valor e taxa como parametros e retornando o valor formatado com o valor convertido e o simbolo da moeda destibo.

- Conversões possíveis:
    - Real
    - Dólar
    - Euro

## Instruções para uso

O projeto possui pode ser executado diretamente, ou executado via docker através do comando

> docker-compose up

Após o inicio, estara disponivel os seguintes endpoints, através da ulr: http://localhost:3000/ :

- /health
    Endpoint para verificar a saúde da aplicação

- /exchange
    Endpoint responsável por realizar a conversão de valores, e deve-se passar os seguintes parâmetros:
    - from: De qual moeda será a moeda que será realizada a conversão. Opções disponíveis: "BRL" , "EUR" e "USD"
    - to: Para qual moeda será a moeda que será realizada a conversão. Opções disponíveis: "BRL" , "EUR" e "USD"
    - value: Valor da moeda de origem que será convertido para a moeda distino. Valor pode conter casas decimais
    - tax: Taxa do câmbio entre as moedas. Valor pode conter casas decimais

    Exemplo de chamada com parâmetros:
        -http://localhost:3000/exchange?from=BRL&to=USD&value=1656.23&tax=0.192518

## Características

- Desenvolvida em node.js
- A API retorna apenas em formato de `json`
- Tratamento de parâmetros, este está presente e no formato esperado
- Não foi utilizado o banco de dados para salvar informações sobre a moeda, mas é possivel facilmente adiciona-lo através da camada de serviço
- Junto ao projeto possui a pasta "database", que contém o "json-server", um banco de dados salvo em formato JSON no arquivo "db.json". Para passar a usar este banco de dados ao invés de dados em código, alterar a classe "currencyService.js" para código que está comentado

## Teste unitários

Para executar os testes unitários, deve-se executar o comando:

> npm run test

Para analisar a cobertura de código, deve-se executar o comando:

> npm run test:cov
