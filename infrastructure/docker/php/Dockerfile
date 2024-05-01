FROM php:8.2-fpm-alpine AS base

# Region ENV setup
ENV TZ          Europe/Prague
ENV LANG        en-US.UTF-8
ENV LANGUAGE    en-US.UTF-8
ENV LC_ALL      en-US.UTF-8

# Update system, kernel, required dependencies and add bash because sh sucks.
RUN apk update && \
    apk add libxrender libxext gcompat fontconfig libstdc++ libpng-dev libjpeg libjpeg-turbo-dev icu-dev && \
    apk add --no-cache bash linux-headers $PHPIZE_DEPS

# Set limits
RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;
RUN echo 'post_max_size = 300M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;
RUN echo 'upload_max_filesize = 100M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# Install PHP Extensions
RUN apk add --no-cache autoconf g++ imagemagick-dev libtool make pcre-dev && \
    pecl install imagick && \
    docker-php-ext-enable imagick
RUN docker-php-ext-install mysqli pdo_mysql gd exif intl

# Wkhtmltopdf
#RUN wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
#RUN tar vxf wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
#RUN cp wkhtmltox/bin/wk* /usr/local/bin/
#RUN rm -rf wkhtmltox

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer

WORKDIR /app
RUN mkdir -p /app/var/cache && chmod -R 777 /app/var/cache

## Install dev-specific dependencies
FROM base AS dev
RUN pecl install xdebug && docker-php-ext-enable xdebug

## Prepare all dependencies required for testing
FROM base AS test

COPY ../.. /app
RUN composer install --dev

## Create production (eg. dev-stage) Image
FROM base AS prod

COPY ../.. /app
RUN composer install -o

## Setup OP Cache
RUN docker-php-ext-install opcache && docker-php-ext-enable opcache

## Override entrypint
COPY ./infrastructure/docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]