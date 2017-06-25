FROM php:7.1.6-fpm-alpine

RUN apk update \
  && apk add libmcrypt-dev \
  && docker-php-ext-install mcrypt mysqli pdo_mysql \
  && rm /var/cache/apk/*