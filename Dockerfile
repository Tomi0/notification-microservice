FROM php:8.3-fpm-bookworm

COPY --from=composer:2.1.9 /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    procps \
    nginx

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_mysql sockets

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install --optimize-autoloader

COPY ./docker/entrypoint.sh /entrypoint.sh
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY ./docker/nginx/default.conf /etc/nginx/sites-enabled/default
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

RUN useradd -ms /bin/bash NotificationUser

RUN chown -R NotificationUser:NotificationUser /var/www/html

ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
