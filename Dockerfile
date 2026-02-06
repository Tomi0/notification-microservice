FROM composer:2.8.8 AS composer

FROM php:8.4-fpm-alpine

ENV TZ="Europe/Madrid"

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk --no-cache add curl \
    git \
    nano \
    supervisor \
    icu-dev \
    oniguruma-dev \
    zlib-dev \
    libzip-dev \
    zip \
    mariadb-client \
    nginx \
    libtool \
    autoconf \
    gcc \
    g++ \
    make \
    icu-dev \
    bash \
&& docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
        intl

RUN rm -rf /var/www/html/index.nginx-debian.html
COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install --optimize-autoloader --no-dev

COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY ./docker/nginx/default.conf /etc/nginx/http.d/default.conf

COPY ./docker/supervisor/supervisor.conf /etc/supervisord.conf

COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN adduser -D -s /bin/sh user

RUN chown -R user:user /var/www/html

EXPOSE 80

ENTRYPOINT ["/bin/sh", "-c", "/entrypoint.sh"]

