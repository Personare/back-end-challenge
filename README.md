# back-end-challenge

> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

## Especificação
Aplicação de conversão de moedas, formatação numérica em decimal com separação de centavos com ponto, sistema não aceita vírgula, Valores devem ser informados em Query String
> - heroku url example: https://exchange-currency-api.herokuapp.com/api?from=USD&to=BRL&value=3&cotation=5.29
> - docker url example: http://127.0.0.1:3001/api?from=USD&to=BRL&value=1&cotation=5.29


## Run
> - build a docker docker application with ` sh scripts/build.sh `
> - access http://127.0.0.1:3001/api
> - run test inside docker ` sh scripts/test.sh `

## Deploy
> - Aplicação esta rodando no heroku : https://exchange-currency-api.herokuapp.com/api
> - utilizando cloud database https://www.elephantsql.com/ 