FROM composer:latest

RUN apk add --no-cache \
    autoconf \
    g++

RUN pecl install ast xdebug

RUN docker-php-ext-enable ast xdebug
