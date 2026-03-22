FROM php:8.4-apache

WORKDIR /var/www/html

# Common utilities and Composer for dependency management in container.
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip zip \
    && rm -rf /var/lib/apt/lists/*

COPY . .
COPY --from=composer:2.9.5 /usr/bin/composer /usr/local/bin/composer

RUN composer install

EXPOSE 80
