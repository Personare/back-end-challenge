# API de cotações do Personare

## Exemplo de uso
```
curl 'http://localhost:8000/?value=3.5&currency_to=brl&currency_from=usd&exchange=2'
```
```JSON
{"symbol":"R$","value":7}
```
## Documentação
**Método:** GET
**Parâmetros obrigatórios:**
* **value:** Valor a ser convertido
* **currency_to:** Moeda original
* **currency_from:** Moeda convertida
* **exchange:** Taxa de câmbio a ser usada

Possíveis valores para os parâmetros `currency_to` e `currency_from` são: 'brl', 'usd' e 'eur'.

OBS.: Caso o parâmetro `exchange` não seja passado e o parâmetro `currency_to` seja 'brl', usaremos a taxa de câmbio fornecida por https://economia.awesomeapi.com.br

## Retornos esperados
### Sucesso:
**Código:** 200
```JSON
{"symbol":"R$","value":7}}}
```
### Erro:
**Código:** 400
```JSON
{
    errors: [
       "Faltam parâmetros obrigatórios",
       "Apenas suportamos as seguintes moedas: brl, usd, eur"
    ]
}
```
### O que fazer?
Conferir a documentação e fazer os ajustes necessários.
