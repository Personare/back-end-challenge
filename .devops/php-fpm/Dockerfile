FROM php:7.1-fpm-alpine

# Define env variables
ENV COMPOSER_VERSION 1.5.1
ENV PHPUNIT_VERSION 6.2

# Add packages from APK
RUN apk --no-cache add curl git subversion openssh openssl mercurial tini bash zlib-dev

# Add packages from docker install
RUN docker-php-ext-install zip pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION}
RUN chmod +x /usr/local/bin/composer

# Install PHPUnit
RUN wget https://phar.phpunit.de/phpunit-${PHPUNIT_VERSION}.phar
RUN chmod +x phpunit-${PHPUNIT_VERSION}.phar
RUN mv phpunit-${PHPUNIT_VERSION}.phar /usr/local/bin/phpunit

# Set up the volumes and working directory
VOLUME ["/var/www/app"]
WORKDIR /var/www/app

# Open Port
EXPOSE 9000

# Command Execute
CMD ["php-fpm"]