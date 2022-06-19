FROM php:7-fpm
RUN apt-get update && docker-php-ext-install pdo_mysql
WORKDIR /www
EXPOSE 80
