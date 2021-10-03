ARG PHPTYPE=fpm
FROM php:8.0-$PHPTYPE as php

ARG CONTAINER_UID=1000
ARG CONTAINER_GID=1000

RUN mkdir -p /var/www/html && mkdir -p /home/www-data/.composer

RUN usermod -u $CONTAINER_UID www-data && groupmod -g $CONTAINER_GID www-data
RUN chown -R www-data:www-data /var/www/html && chown -R www-data:www-data /home/www-data

WORKDIR /var/www/html

USER www-data




FROM php as tool

USER root

RUN apt update && apt install -y git zlib1g-dev libzip-dev unzip \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY .docker/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

USER www-data




FROM php as dev

USER root

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY .docker/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

USER www-data

COPY --chown=www-data:www-data . /var/www/html




FROM composer as composer

COPY composer.json composer.json
COPY composer.lock composer.lock
COPY symfony.lock symfony.lock

RUN composer install --no-scripts --no-dev --no-autoloader --no-interaction

COPY . /app

RUN composer dump-autoload




FROM php as prod

WORKDIR /var/www/html

COPY --chown=www-data:www-data --from=composer /app/vendor /var/www/html/vendor

COPY --chown=www-data:www-data . /var/www/html