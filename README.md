# back-end-challenge reply

> Resposta ao desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

## Introdução

API para conversão de moedas feito com PHP.

## Requirements
[Docker](https://docs.docker.com/install/)
[Docker Compose](https://docs.docker.com/compose/install/)

## Instruções

1. Clonar o repositório `git clone https://github.com/cberton/back-end-challenge.git`;
2. Entrar na pasta `cd back-end-challenge`;
3. Acesse a branch *carlos-berton* `git checkout carlos-berton`;
4. Dê permissão de execução para o script run.sh `chmod +x run.sh`;

## Ambiente
Para rodar o ambiente:

```
# criando o ambiente
./run.sh build

# testando
./run.sh test

# iniciando
./run.sh start
```

## Utilizando a API
Para realizar a conversão de uma moeda basta fazer uma requisição com os argumentos:
- `from` (obrigatório);
- `to` (obrigatório);
- `amount` (obrigatório);
- `repository` (opcional).

Exemplo:

```
# utilizando repositorio fixo
# os valores de ratio estão hard code no index.php
curl -i -X GET "http://0.0.0.0:8001/?from=USD&to=BRL&amount=10"

# utilizando repositorio cryptocompare
# os valores de ratio são da API do CryptoCompare
curl -i -X GET "http://0.0.0.0:8001/?from=EUR&to=USD&amount=34.56&repository=cryptocompare"
```
