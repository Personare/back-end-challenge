# Personare Teste - PHP

>Esse projeto é responsável por efetuar o calculo de cotação a partir das entradas **__vide espesificacao__**

_As especificações são_:

- A requisição deve receber a cotação via parâmetro
- A resposta deve conter o valor convertido e o símbolo da moeda
- Conversões:
    - De Real (R$) para Dólar
    - De Dólar ($) para Real
    - De Real (R$) para Euro
    - De Euro (€) para Real

## Instalação

1. Instale a linguagem PHP em seu computador [Instruções](https://www.youtube.com/watch?v=KwEilZK5d04).
2. Instale o gerenciador de pacotes [Composer](https://getcomposer.org) em seu computador.
3. Utilize o comando `composer install` dentro do diretório do projeto, para gerar o diretório 
   vendor com as bibliotecas necessárias para o projeto.

___

## Documentação para uso da API

- Parâmetro para as buscas **GET**

- Parâmetros de uso:
    - `moeda_origem`: moeda que deseja cambiar. 
    - `moeda_destino`: moeda para qual deseja o câmbio.
    - `valor`: o valor que deseja cambiar.
    - `cotacao`: a cotação da moeda.
  
- Sigla para as moedas:
    - Euro: `EUR`
    - Real: `BRL`
    - Dólar: `USD`

    
- Possíbilidades de câmbio:
    - `BRL-USD` [Cotação](www.google.com/search?q=cotação+real+-+dólar)
    - `BRL-EUR` [Cotação](www.google.com/search?q=cotação+real+-+euro)
    - `USD-BRL` [Cotação](www.google.com/search?q=cotação+dólar+-+real)
    - `EUR-BRL` [Cotação](www.google.com/search?q=cotação+euro+-+real)
  

- Formatação para entrada de Valores (cotacao - valor) `99999.9999`


___

## Postman
A collection para acessar os endpoints via postman se encontram em:

[postman_collection](./storage/Personare.postman_collection.json).

Saiba mais sobre o postman em: [Postman](https://www.postman.com/)
___
## Testes unitários:

Para executar os testes unitários:

Digite o comando no terminal dentro do diretório do projeto. [`vendor/bin/phpunit tests/`]

**Obs**: Para efetuar completamente os testes suba o servidor com `php -S localhost:8000` com o cmd dentro do diretório do projeto.
