FROM php:8.4.2-cli AS main

RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libbrotli-dev libxml2-dev libzip-dev zip unzip tini \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN docker-php-ext-install pdo_mysql mbstring pcntl bcmath gd intl zip opcache \
    && pecl install redis  && docker-php-ext-enable redis \
    && pecl install swoole  && docker-php-ext-enable swoole

COPY --from=composer:2.8.4 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www


FROM main AS dev

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

ENV PHP_IDE_CONFIG "serverName=localhost"

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
