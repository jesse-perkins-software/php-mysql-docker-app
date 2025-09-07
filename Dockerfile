FROM php:8.2-apache

RUN docker-php-ext-install mysqli

RUN docker-php-ext-enable mysqli

WORKDIR /var/www/html

COPY php-files/ /var/www/html/

EXPOSE 80