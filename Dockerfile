ARG COMPOSER_VERSION=1.9
ARG PHP_VERSION=7.4

FROM composer:${COMPOSER_VERSION} AS composer_base
FROM php:${PHP_VERSION}-fpm AS php_base

COPY --from=composer_base /usr/bin/composer /usr/bin/composer

RUN pecl install redis && \
    docker-php-ext-enable redis && \
    apt update && \
    apt install -y git zlib1g-dev libzip-dev && \
    docker-php-ext-install zip

COPY . .

RUN composer install

