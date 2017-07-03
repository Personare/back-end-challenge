# Personare Challenge (Convert API)

## Resumo: 
Projeto desenvolvido com o objetivo de demonstrar conhecimentos em PHP, Programação orientada a objetos, Padrões PHP (PSR), composer, packages e etc.


## Tecnolgoias/Libs utilizadas para o desenvolvimento:
#### Principal
- **PHP 5.6+**

#### Libs (Auxiliares)
- phpunit/phpunit
- money-convert (Criada por mim, também para esse projeto)


## Modo de uso
1) Clonar o repositório https://github.com/AzeredoGabriel/back-end-challenge
2) Troque de branch para -> gabriel-almeida
3) Navegue até a pasta /personare-convert-api
4) Execute o comando 
``` 
composer update - Para instalar todos os componentes necessários
```
5) Execute o comando
```
php -S localhost:3000 - Para inicar a aplicação
```

6) Acesse http://localhost:3000 e veja a aplicação rodando. :)


OBS: Para rodar os testes no package money-convert vá até vendor\money-convert\vendor\bin\phpunit tests/