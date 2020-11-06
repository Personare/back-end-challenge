FROM php:7.4-apache
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp