FROM php:7.4-cli

RUN apt-get update && apt-get install -y \ 
    libpq-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev

RUN docker-php-source extract \ 
    && docker-php-ext-configure intl && docker-php-ext-install intl \
    && docker-php-ext-install pdo pdo_mysql pgsql pdo_pgsql \
    && docker-php-source delete
