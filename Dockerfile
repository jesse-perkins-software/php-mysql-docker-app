FROM php:8.2-apache

WORKDIR /var/www/html

COPY php-files/ /var/www/html/

EXPOSE 80