

## API de conversão de moedas

>Abaixo seguem as configurações para rodar a aplicação


## Configuração

- Criar um banco de dados a sua escolha, Ex: 'backend_challenge';
- Importar o dump da tabela de moedas que se encontra no diretório db;
- Alterar as configurações de conexão com o banco em config/config.php;
- Toda a documentação de utilização da API encontra-se na página inicial da mesma;

## Documentação

>A mesma é exibida na página inicial da API

```js
{
    "/": "Documentação de utilização da api",
    "/moedas": {
        "/": {
            "Métodos": [
                "GET"
            ],
            "Resultado": "Retorna um array com o total de resultados e as os objetos das moedas cadastradas",
            "Exemplo de Retorno": {
                "count": 2,
                "results": [
                    {
                        "id": 1,
                        "nome": "Real Brasileiro",
                        "simbolo": "R$",
                        "sigla": "BRL"
                    },
                    {
                        "id": 2,
                        "nome": "U.S. Dollar",
                        "simbolo": "$",
                        "sigla": "USD"
                    }
                ]
            }
        },
        "/view/{id}": {
            "Métodos": [
                "GET"
            ],
            "Resultado": "Retorna um objeto com os dados da moeda buscada através do seu id",
            "Exemplo de Retorno": {
                "id": 1,
                "nome": "Real Brasileiro",
                "simbolo": "R$",
                "sigla": "BRL"
            }
        },
        "/add": {
            "Métodos": [
                "POST"
            ],
            "Resultado": "Cadastra uma moeda no banco de dados retornando o objeto cadastrado ou um objeto de erro caso os dados estejam incorretos",
            "Exemplo de Requisição": {
                "nome": "Euro",
                "simbolo": "€",
                "sigla": "EUR"
            },
            "Exemplo de Retorno": {
                "id": 3,
                "nome": "Euro",
                "simbolo": "€",
                "sigla": "EUR"
            }
        },
        "/update/{id}": {
            "Métodos": [
                "PUT"
            ],
            "Resultado": "Atualiza uma moeda no banco de dados, de acordo com o id informado, retornando o objeto atualizado ou um objeto de erro caso os dados estejam incorretos",
            "Exemplo de Requisição": {
                "nome": "Libras Esterlinas",
                "simbolo": "€",
                "sigla": "EUR"
            },
            "Exemplo de Retorno": {
                "id": 3,
                "nome": "Libras Esterlinas",
                "simbolo": "€",
                "sigla": "EUR"
            }
        },
        "/delete/{id}": {
            "Métodos": [
                "DELETE"
            ],
            "Resultado": "Apaga a moeda referente ao id informado",
            "Exemplo de Retorno": {
                "sucesso": "Moeda {nome_da_moeda} removida com sucesso!"
            }
        },
        "/converter/{moeda_origem_id}": {
            "Métodos": [
                "POST"
            ],
            "Resultado": "Converte um valor de uma moeda para outra baseado nos parâmetros informados",
            "Exemplo de Requisição": {
                "moeda_destino": 2,
                "valor": "10.00",
                "cotacao": "4.00"
            },
            "Exemplo de Retorno": {
                "moeda_origem": "BRL - Brazillian Real",
                "moeda_destino": "USD - U.S. Dollar",
                "valor": "10.00",
                "cotacao": "4.00",
                "valor_convertido": "$ 2.50"
            }
        }
    }
}
```
