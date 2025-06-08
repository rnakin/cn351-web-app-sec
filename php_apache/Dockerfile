FROM php:8.4-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        iputils-ping \
        libzip-dev \
    && docker-php-ext-install \
        mysqli \
        pdo_mysql \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Configure PHP
COPY php.ini /usr/local/etc/php/conf.d/app.ini

USER www-data
