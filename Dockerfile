FROM php:7.1-apache

ENV APP_HOME /var/www/html
WORKDIR $APP_HOME
COPY . .
RUN chown www-data /var/www/html/*

EXPOSE 80