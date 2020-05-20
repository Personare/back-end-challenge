![CI](https://github.com/elvishp2006/back-end-challenge/workflows/CI/badge.svg?branch=elvis-pereira)

# Exchange API

## Dependencias

1. docker
1. docker-composer

## Executando o projeto

1. Execute `git clone https://github.com/elvishp2006/back-end-challenge.git -b elvis-pereira` no seu terminal
1. Entre na pasta clonada
1. Execute `docker-compose up`
1. Acesse http://localhost:8000/exchange/10/BRL/USD/5.5 (Formato: exchange/{valor}/{from}/{to}/{rate})
1. Para rodar no modo produção: `docker-compose build && docker-compose -f docker-compose.yml up -d`

### Usando o serviço PHP composer

> Este serviço se encontra no `docker-compose.override.yml`, certifique-se de substituir o `user: 1000:1000` pelo seu user id e group id, com isso não terá problemas de permissões na pasta `vendor`

1. Executando testes unitários: `docker-compose run --rm composer test`
1. Executando lint com phpcs: `docker-compose run --rm composer lint`
1. Executando lint-fix com phpcbf: `docker-compose run --rm composer lint-fix`
1. Executando análise estática de código com Phan: `docker-compose run --rm composer static-analysis`
1. Executando todos os comandos acima de uma só vez: `docker-compose run --rm composer ci`
