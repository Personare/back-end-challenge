FROM covex/php7.1-apache

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app \
    && a2enmod rewrite

RUN cd /srv/app && composer install && ./vendor/bin/phpunit
