FROM php:7-fpm
RUN apt-get update && docker-php-ext-install pdo_mysql
COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh
WORKDIR /www
EXPOSE 80
RUN /docker-entrypoint.sh
