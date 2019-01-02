# back-end-challenge

> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

[![Build Status](https://travis-ci.org/iagocavalcante/back-end-challenge.svg?branch=iago-cavalcante)](https://travis-ci.org/iagocavalcante/back-end-challenge)

## Dependências:

* PHP 7.3 ou > 
* Composer

## Executando localmente

#### 1 - Baixando projeto

Primeiramente será necessário efetuar o clone do repositório do github, baixando a branch iago-cavalcante:

```
git clone https://github.com/iagocavalcante/back-end-challenge -b iago-cavalcante
cd back-end-challenge
```
#### 2 - Instalando dependências e executando o projeto

Para executar o projeto, abra o terminal de sua preferência e navegue até a pasta back-end-challenge

```
cd back-end-challenge
```

Feito isso, instale as dependências necessárias para executar o projeto:
```
composer install
```

#### 3 - Rodando os testes

Para executar os testes no projeto, execute o seguinte comando caso esteja no windows:
```
composer test-windows
```

caso esteja no linux ou OSx, execute:
```
composer test
```

#### 4 - Rodando a aplicação:
Para executar a aplicação, basta rotadar o seguinte comando:

```
php -S localhost:8000 -t public/
```

Logo a API estará acessível no endereço http://localhost:8000

Conferindo se a API está sendo executada corretamente, acesse o navegador ou use cURL com os parametros from, to e amount

```
curl -i -X GET "http://localhost:8000/?from=EUR&to=BRL&amount=23.23"
```

A API está publicado no heroku e para conferir basta acessar o seguinte endereço:

[API no heroku](http://personare-backend.herokuapp.com/?from=USD&to=EUR&amount=26.7)