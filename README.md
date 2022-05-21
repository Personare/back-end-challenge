![lint](https://github.com/emanuelinacio/back-end-challenge-private/actions/workflows/lint.yml/badge.svg) ![test](https://github.com/emanuelinacio/back-end-challenge-private/actions/workflows/test.yml/badge.svg) 
# back-end-challenge

> Challenge for future backends of the [@Personare](https://github.com/Personare) referring to [repositório](https://github.com/emanuelinacio/back-end-challenge-personare)

## Features

A solution was developed for the proposed challenge of creating the API, following information:

Exchange endpoint: Perform a currency conversion **Acceptable Coins**
* BRL - Brazilian Real ( R$ )
* USD - American dollar ( $ )
* EUR - Euro ( €)

**GET/exchange/**

> http://localhost:8080/exchange/{amount}/{from}/{to}/{rate}

* amount: number required
* from: string required acceptable ( BRL | USD | EUR )
* to: string required acceptable ( BRL | USD | EUR )
* rate: number required


> API documentation link [Personare](https://documenter.getpostman.com/view/19400342/UyxoiQ4e)

## Tools
* For testing used tool [codeception/codeception](https://packagist.org/packages/codeception/codeception)
* For lint used tool [squizlabs/php_codesniffer](https://packagist.org/packages/squizlabs/php_codesniffer)
* Integration continues [Github Actions](https://docs.github.com/en/actions/using-workflows/workflow-syntax-for-github-actions) ( on push | on pullrequest ) test e lint
* Tool API Documentation [Postman](https://www.postman.com/)

## Requirements

* PHP 8.1
* Composer

## Run API, lint and tests

* Run `composer install`
* Run `php -S localhost:8080 index.php`
* Run `composer lint` 
* Run `composer test`

## Directory Structure
```shell
├── src/  
│   ├── Entities/
│   │   ├── Currency.php
│   ├── Providers/
│   │   ├── Currency/
│   │   │   ├── Calculate.php
│   │   │   ├── Controller.php
│   │   │   ├── Response.php
│   │   │   ├── Validated.php
│   ├── Services/
│   │   ├── Exchange.php
│   ├── Core.php
├── tests/  
│   ├── _output/
│   ├── _support/
│   ├── api/
│   │   ├── 001-ValidatedCest.php
│   │   ├── 002-ExchangeCest.php
│   ├── api.suite.yml
└── index.php 
