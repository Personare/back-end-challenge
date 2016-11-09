# Como rodar o projeto

O projeto constitui de um container docker web e um database configurados via docker-compose. Abra o terminal e execute na pasta o comando abaixo:

```bash
docker-compose up -d
```

Caso não tenha o docker-compose instalado, será necessário informar as variáveis de ambiente abaixo para o container 'web' e ter uma instância do mysql rodando em algum lugar:
- MYSQL_HOSTNAME
- MYSQL_DATABASE
- MYSQL_USERNAME
- MYSQL_PASSWORD

Após iniciar o container, acesse a url: http://localhost/?from=BRL&to=USD&value=1.99

O docker fará o build da imagem web e depois rodará os dois novos containers. Está configurado para expor as portas 80 (web) e 3306 (mysql)

As opções válidas para os parâmetros 'from' e 'to' são: 'BRL', 'USD' e 'EUR'.
O parâmetro 'value' deve ser float, ou seja, com ponto decimal. Ex: 2.99

### Como rodar os testes unitários

Necessário ter o phpunit instalado. Rode no terminal, na pasta do projeto:
```bash
phpunit -c phpunit.xml test
```

### Como rodar os testes de integração

Para os testes de integração, é necessário ter o projeto web e o database rodando em algum lugar, informar a url do serviço web e configurar o acesso ao banco de dados.
```bash
PERSONARE_URL=http://172.28.0.1 MYSQL_HOSTNAME=172.28.0.1 MYSQL_USERNAME=root MYSQL_DATABASE=coin_conversion_test phpunit -c phpunit-it.xml test
```

No caso de estar usando os containers docker, rode o comando abaixo para saber qual o ip do host web e do db:
```bash
docker inspect <nomedocontainer> | grep "Gateway"
```
Obs: no docker o usuário do banco de dados está sem senha, caso esteja usando um outro database, não se esqueça de fornecer o parâmetro de senha.

## Decisões de Projeto

Não foi feito validação caso entre com combinação inválido (ex: from=BRL e to=BRL) ou opções inválidas.

- Conforme solicitado, feito com orientação a objetos fortemente, utilizando conceitos S.O.L.I.D e DRY.
- Todo projeto de fácil manutenção e extensão. Por exemplo, se quiser usar MongoDb no lugar do Mysql, será necessário apenas criar uma classe estendendo a interface QuotationDS e alterar a fábrica que a instancia em QuotationDSFactory.
- Outro facilidade é caso queira utilizar arquivo de configuração no lugar de variáveis de ambiente. Mesmo processo, criar uma classe que estenda a interface Environment e alterar os locais onde são instanciados a classe LocalEnvironment. Poderia ter criado uma nova factory, mas não foi necessário por enquanto.
- As moedas são facilmente adicionadas também, bastando criar uma classe estendendo Currency e alterar o arquivo CurrencyFactory para reconhecer o novo formato.
- Optei também por deixar o simbolo dentro da classe por ser algo que não muda com frequência. É mais fácil alguém, por engano, alterar o valor de uma linha no banco de dados do que na classe que depende de deploy.
- Como foi solicitado não utilizar framework, contruí de forma bem rudimentar o MVC, onde a rota é através de arquivos .php na pasta html que chamam ações em Controllers diretamente. A Controller trabalha nos parâmetros e envia-os para os [BO's](https://en.wikipedia.org/wiki/Business_object), que retorna algum objeto de modelo. E por fim ela transforma a informação para a view.
- Por questões de facilidade, não criei nada abstraindo a camada de visualização. Apenas retornando a string diretamente. Caso fosse um projeto maior, ou mesmo entrarem novas funcionalidades aumentando a complexidade, será necessário abstrair isto também.
- Os testes unitários estão apenas na camada de domínio, a camada de infraestrutura e integrações estão são validadas por testes de integração.
- Os testes de integração destroem os dados de cotação do banco de dados. Sendo assim, não se esqueça de restaurá-los caso queira usar novamente o micro-webservice pela URL novamente.

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

- PHP >= 5.6
- Orientado a objetos
- Test Driven Development
- A API deve retornar em formato de `json`

## Diferenciais

- S.O.L.I.D
- Boa documentação
- Não utilizar framework
- Utilização de DDD (Domain Driven Design)
- Implementar integração contínua
- Testes de aceitação

## Dúvidas

Se surgir alguma dúvida, consulte as [perguntas feitas anteriormente](https://github.com/Personare/back-end-challenge/labels/question).

Caso não encontre a sua resposta, sinta-se à vontade para [abrir uma issue](https://github.com/Personare/back-end-challenge/issues/new) =]
