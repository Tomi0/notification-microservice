FROM composer:2.1.9 AS composer

FROM php:8.3-cli-bookworm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    unzip

WORKDIR /app

COPY . /app

RUN docker-php-ext-install pdo_mysql sockets
