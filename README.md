# back-end-challenge

> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

## Introdução

A nossa Product Owner pensou em um produto fantástico para ser desenvolvido, porém é necessário realizar uma conversão de moedas para que tudo funcione perfeitamente e essa é a única feature que está faltando para entregarmos o projeto.

**Então, essa é a sua missão!**

É isso mesmo, você deverá criar uma API que realize conversão de moedas. 

E as especificações são:

- A requisição deve receber a cotação via parâmetro
- A resposta deve conter o valor convertido e o símbolo da moeda
- Conversões:
    - De Real para Dólar
    - De Dólar para Real
    - De Real para Euro
    - De Euro para Real

## Instruções

1. Efetue o **fork** deste repositório e crie um branch com o seu nome. (ex: caue-alves).
2. Após finalizar o desafio, crie um **Pull Request**.
3. Aguarde algum contribuidor realizar o code review.

## Pré-requisitos

- Você pode usar a linguagem que preferir. (Preferência para PHP >= 5.6, Javascript ou Python)
- Orientado a objetos
- Test Driven Development
- A API deve retornar em formato de `json`

## Diferenciais

- S.O.L.I.D
- Boa documentação
- Não utilizar framework
- Utilização de DDD (Domain Driven Design)
- Implementar integração contínua

## Dúvidas

Se surgir alguma dúvida, consulte as [perguntas feitas anteriormente](https://github.com/Personare/back-end-challenge/labels/question).

Caso não encontre a sua resposta, sinta-se à vontade para [abrir uma issue](https://github.com/Personare/back-end-challenge/issues/new) =]



## Desafio Backend Personare - Vinícius Nyari - 48 99137 8387 - viniciusnyari@gmail.com

### As cotações

As cotações podem consultar uma API para buscar a cotação online e apartir desse momento, realizar a conversão de origem e destino, porém, em muitos casos, a empresa adota a sua própria cotação, que não é a do mercado. Diante disso, a API abaixo, foi pensada dessa forma, por isso, que a mesma requer o valor a ser convertido (na moeda de origem), a taxa de conversão praticada pela empresa e a moeda de destino nos formatos (BRL - Real, EUR - Euro e USD - Dólar). 
Abaixo, alguns exemplos de chamadas da API:

- Dólar para Real
	- http://localhost:porta/ConversaoMoedas/120.5/5.63/BRL
	- Retorno:
	{
		"simbolo": "R$",
		"valorConvertido": 678.415
	}

- Euro para Real
	- http://localhost:porta/ConversaoMoedas/25/6.47/BRL
	- Retorno:
	{
	  "simbolo": "R$",
	  "valorConvertido": 161.75
	}

- Real para Dólar
	- http://localhost:porta/ConversaoMoedas/135.90/0.18/USD
	- Retorno:
	{
	  "simbolo": "$",
	  "valorConvertido": 24.462
	}

- Euro para Dólar
	- http://localhost:porta/ConversaoMoedas/25/1.16/USD
	- Retorno:
	{
	  "simbolo": "$",
	  "valorConvertido": 28.999999999999996
	}

- Dólar para Euro
	- http://localhost:porta/ConversaoMoedas/50.5/0.86/EUR
	- Retorno:
	{
	  "simbolo": "€",
	  "valorConvertido": 43.43
	}

- Real para Euro
	- http://localhost:porta/ConversaoMoedas/85.5/0.15/EUR
	- Retorno:
	{
	  "simbolo": "€",
	  "valorConvertido": 12.825
	}

### Documentação

Ao executar a aplicação pelo Visual Studio a tela inicial abrirá a documentação através do endereço 'http://localhost:porta/index.html', no qual, poderá conhecer os parâmetros de entrada e o retorno.