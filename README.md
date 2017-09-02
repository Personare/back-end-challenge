Esta aplicação tem como base a conversão de moedas.

##  Instalar Projeto

Esta aplicação tem como base o docker utilizando o docker compose.

`docker-compose up -d`

## Instalar dependencias do PHP

Esta aplicação utiliza o composer como gerenciador de dependências

Para instalar as dependencias executar o comando:

```
docker-compose exec php composer install
```

Qualquer outro comando composer deve ser executado da seguinte forma:

```
docker-compose exec php composer ...
```

## Base de dados

Para esta aplicação foi utilizada a técnica de migrations, e para executa-las utilize os comandos abaixo

```
docker-compose exec php php vendor/bin/phinx migrate
```

Para popular os dados do utilize o seguinte comando:

```
docker-compose exec php php vendor/bin/phinx seed:run
```

## Testes Unitários

Para executar os testes unitários utilize o comando abaixo

```
docker-compose exec php phpunit
```

## Acessando a conversão de moedas

Rota
```
http://localhost:1234/exchange/{amount}/{from}/{to}/{rate}
```

Exemplo
```
http://localhost:1234/exchange/187.65/USD/BRL/3.13
```