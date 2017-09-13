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
## Testes Unitários

Para executar os testes unitários utilize o comando abaixo

```
phpunit
```
ou
```
composer test
```

## Acessando a conversão de moedas

Rotas
```
http://localhost:1234/exchange/{amount}/{from}/{to}
http://localhost:1234/exchange/{amount}/{from}/{to}/{rate}
```

Exemplo com taxa para conversão
```
http://localhost:1234/BRL/USD/60000
http://localhost:1234/USD/BRL/60000

http://localhost:1234/BRL/USD/60000/0.37
http://localhost:1234/USD/BRL/60000/3.08
```

Exemplo sem taxa para conversão
```
http://localhost:1234/exchange/23.00/BRL/USD
http://localhost:1234/exchange/187.65/USD/BRL

http://localhost:1234/exchange/12.00/BRL/EUR
http://localhost:1234/exchange/65.12/EUR/BRL
```
