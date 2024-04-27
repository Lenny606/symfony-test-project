FROM php:8.1-fpm
LABEL authors="thoma"

WORKDIR /app
RUN apt-get update
RUN apt-get -y install git zip libpq-dev
RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN pecl install xdebug


CMD ["php-fpm"]