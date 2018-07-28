# Como executar


#### Dependências


[Docker](https://docs.docker.com/install/) 17.12.1-ce ou superior

[Docker Compose](https://docs.docker.com/compose/install/) 1.19.0 ou superior

#### Procedimentos iniciais

Faça o clone do repositório e entre na pasta do projeto:

```
git clone git@github.com:Chavao/back-end-challenge.git
cd back-end-challenge
```

Garanta que o script auxiliar está com permissão de execução, executando o comando:

```
chmod +x run
```

Garanta que a porta 5001 não esteja sendo utilizada neste computador.

#### Construindo o ambiente

Para construir o ambiente, basta executar:

```
./run setup
```

Esse comando executará build das do container, instalará o composer e subirá o serviço web na porta 5001.


#### Executando os testes automatizados

```
./run test
```

#### Conversão de câmbio

[GET]

Para obter os valores de uma moeda, basta executar os comandos abaixos:

```
curl -i -X GET "http://0.0.0.0:5001/?from=USD&to=BRL&value=10"
curl -i -X GET "http://0.0.0.0:5001/?from=BRL&to=USD&value=15"
curl -i -X GET "http://0.0.0.0:5001/?from=EUR&to=BRL&value=20"
curl -i -X GET "http://0.0.0.0:5001/?from=BRL&to=EUR&value=30"
```

#### Extra

O setup do banco de dados fica no arquivo `public/bootstrap.php`, para adicionar mais moedas, basta acrescentar os dados na função `createFakeDatabase()`.
