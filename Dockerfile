FROM composer:2.8.8 AS composer

FROM php:8.5-fpm-alpine

ARG USER_ID=1000
ARG GROUP_ID=1000

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN addgroup -g $GROUP_ID notification_user && \
    adduser -u $USER_ID -G notification_user -D notification_user

RUN apk --no-cache add curl \
    git \
    nano \
    icu-dev \
    oniguruma-dev \
    zlib-dev \
    libzip-dev \
    zip \
    mariadb-client \
    libtool \
    autoconf \
    gcc \
    g++ \
    make \
    bash \
    linux-headers \
&& docker-php-ext-install \
        bcmath \
        sockets \
        pdo_mysql \
        mbstring \
        zip \
        intl


RUN rm -rf /var/www/html/* && chown notification_user:notification_user /var/www/html

COPY --chown=notification_user:notification_user . /var/www/html

WORKDIR /var/www/html

RUN composer install --optimize-autoloader --no-dev

COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --chmod=744 --chown=notification_user:notification_user ./docker/entrypoint.sh /entrypoint.sh

USER notification_user

ENTRYPOINT ["/bin/sh", "-c", "/entrypoint.sh"]

