FROM php:5.6-apache

MAINTAINER "Marcio Vinicius <marciovmartins@hotmail.com>"

COPY ./src /var/www/src/
COPY ./html /var/www/html/
