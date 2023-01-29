# Conversor monetário

**Conversor monetário** é uma API desenvolvida em PHP puro com o objetivo de converter pares de moedas entre si.


## Requisitos

 - Servidor APACHE atualizado;
 - PHP 7.2 ou superior.

## Como usar
Ao realizar o download do repositório, coloque-o no diretório do **servidor APACHE** responsavel por publicar o projeto. Após a API estar no diretório correto e estar apto a receber as requisições, crie o corpo da requisição em formato **JSON** contendo os seguintes parâmetros: par, qtd e cot. O método de requisição HTTP permitida é o **POST**, em caso de qualquer outro método, a requisição será invalidada.

Exemplo:

    {    
	    "par": "BRL-USD",
	    "qtd": 200,
	    "cot": 0.19    
    }
 
 ### Sobre os parâmetros

 1. par: este parametro deve conter as siglas das moedas a serem convertidas seguindo o padrão: moeda base - moeda cotada. 
 1.1. As moedas aceitas são: BRL => Real brasileiro, USD => Dólar americano e EUR => Euro.
 1.2. As siglas das moedas devem ser separadas por "-".
 2. qtd: este parâmetro é referente a quantidade da moeda base.
 2.1. A quantidade da moeda deve ser interiro ou float, sendo assim, sempre separado pelo ponto flutuante em caso de necessidade.
 3. cot: este parâmetro é referente a cotação da moeda base para a moeda cotada.
 3.1. A cotação deve ser inteiro ou float, sendo assim, sempre separado pelo ponto flutuante em caso de necessidade.

### Erros
 

 - **CM001 -** o **método** utilizado pela API é o **POST**. 
 - **CM002 -** os **atributos** do corpo **JSON** estão incorretos. 
 - **CM003 -** o parâmetro **par** está fora do padrão ou com alguma sigla incorreta.
 - **CM004 -** a quantidade de parâmetros esta incorreta ou algum deles fora do padrão.


### Resposta
Quando a requisição esta correta, ela recebe a resposta em formato **JSON** da seguinte forma:

    {    
	    "par": "BRL-USD",    
	    "moeda_base": "BRL",    
	    "qtd_moeda_base": 200,    
	    "moeda_cotada": "USD",    
	    "valor": 38    
    }

A resposta da API informa o par inserido, seguido da "moeda base" para conversão, a quantidade da moeda base informada, a moeda a ser convertida (moeda cotada) e o valor já convertido entre ambas as moedas.


