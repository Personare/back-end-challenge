
# Currency API - DESAFIO PERSONARE - Samir Ortiz

## Startando a aplicação

No terminal, digite `git clone https://github.com/samirortiz/back-end-challenge.git -b samir-ortiz-ceccim`
Ainda no terminal, na raíz do projeto clonado, digite `docker-compose up`
Acesse a URL <http://localhost:8000/currency/100/BRL/USD/5.7> que foi definida da seguinte forma, conforme exemplo:

1. `/currency/` é o único método disponível, responsável pela conversão de moedas
2. `100` é a quantidade ou valor da moeda que você quer converter
3. `BRL` é a moeda origem, que você tem e quer converter
4. `USD` é a moeda destino, para qual você está convertendo o seu dinheiro atual
5. `5.7` é a cotação da moeda destino, em referÊncia à moeda origem

## Conversões disponíveis

1. BRL -> USD
2. BRL -> EUR
3. USD -> BRL
4. EUR -> BRL

## Testes unitários

Na raíz do projeto, digite no terminal `/vendor/bin/phpunit tests/`

## CI

Disponível no GitHub ao dar push/merge na branch main

## CONTATO

samirortiz@gmail.com / 51 99725-4229

### Abraços
