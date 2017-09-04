Esta aplicação tem como base a conversão de moedas.

##  Instalar Projeto

Esta aplicação tem como base o docker utilizando o docker compose.

```
Copiar o arquivo .env.example para .env
```

```
docker-compose up -d
```

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

Exemplo com taxa para conversão
```
http://localhost:1234/exchange/23.00/BRL/USD/0.31
http://localhost:1234/exchange/187.65/USD/BRL/3.13

http://localhost:1234/exchange/12.00/BRL/EUR/0.26
http://localhost:1234/exchange/65.12/EUR/BRL/4.08
```

Exemplo sem taxa para conversão
```
http://localhost:1234/exchange/23.00/BRL/USD
http://localhost:1234/exchange/187.65/USD/BRL

http://localhost:1234/exchange/12.00/BRL/EUR
http://localhost:1234/exchange/65.12/EUR/BRL
```
