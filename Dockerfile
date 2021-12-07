ARG COMPOSER_VERSION=1.9
ARG PHP_VERSION=7.4

FROM composer:${COMPOSER_VERSION} AS composer_base
FROM php:${PHP_VERSION}-fpm AS php_base

COPY --from=composer_base /usr/bin/composer /usr/bin/composer

RUN pecl install redis && \
    docker-php-ext-enable redis && \
    apt-get update && \
    apt-get install -y git zlib1g-dev libzip-dev && \
    docker-php-ext-install zip

FROM php_base AS build

COPY . .

RUN composer install

FROM php_base AS prod

COPY --from=build --chown=www-data:www-data /var/www/html /var/www/html

FROM php_base AS php_dev

ARG UID=1000
ARG GID=1000

RUN usermod --uid ${UID} www-data && \
    groupmod --gid ${GID} www-data
