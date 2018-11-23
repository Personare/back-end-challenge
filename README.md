# back-end-challenge

> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

[![Build Status](https://travis-ci.org/Tagliatti/back-end-challenge.svg?branch=filipe-tagliatti)](https://travis-ci.org/Tagliatti/back-end-challenge)

## Como executar

#### Dependências

[Docker](https://docs.docker.com/install/) 18.06.1-ce ou superior

[Docker Compose](https://docs.docker.com/compose/install/) 1.22.0 ou superior

#### 1 - Clonando o repositorio

Clone o repositório e entre na pasta do projeto:

```
git clone https://github.com/Tagliatti/back-end-challenge.git
cd back-end-challenge
```

Mide para o branch filipe-tagliatti:

```
git checkout filipe-tagliatti
```

Para executar o projeto a porta 3000 deve estar disponível.

#### 2 - Executando o projeto

O comando abaixo executará o build do container e iniciará o serviço web na porta 3000.

```
docker-compose up -d --build
```

#### 3 - Executando os testes

```
docker-compose exec exchange vendor/phpunit/phpunit/phpunit --testdox
```

#### 4 - Acessando a api

```
curl -i -X GET "http://localhost:3000/?from=USD&to=BRL&value=12"
curl -i -X GET "http://localhost:3000/?from=BRL&to=USD&value=37"
curl -i -X GET "http://localhost:3000/?from=EUR&to=BRL&value=54"
curl -i -X GET "http://localhost:3000/?from=BRL&to=EUR&value=432"
```
