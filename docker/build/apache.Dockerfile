FROM composer AS apache_builder
COPY ./backend /app
WORKDIR /app
RUN composer install --no-dev
RUN composer run-script build

FROM php:8.2-apache

# CONFIG VALUE FILE > .env
ARG URL
ARG URL_ALIAS
ARG PATH_HOST_WWW
ARG PATH_CTNR_WWW
ARG PATH_HOST_CERTS
ARG PATH_CTNR_CERTS
ENV URL ${URL}
ENV URL_ALIAS ${URL_ALIAS}
ENV PATH_HOST_WWW ${PATH_HOST_WWW}
ENV PATH_CTNR_WWW ${PATH_CTNR_WWW}
ENV PATH_HOST_CERTS ${PATH_HOST_CERTS}
ENV PATH_CTNR_CERTS ${PATH_CTNR_CERTS}

COPY --chown=www-data:www-data ./docker/php/ /usr/local/etc/php/
COPY --chown=www-data:www-data ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY --chown=www-data:www-data --from=apache_builder /app/vendor /var/www/html/vendor
COPY --chown=www-data:www-data --from=apache_builder /app/dist /var/www/html/dist
COPY --chown=www-data:www-data --from=apache_builder /usr/bin/composer /usr/bin/composer

RUN apt-get update -y && apt-get upgrade -y \
     && apt-get install -y curl libzip-dev zip unzip nano \
     &&  /usr/local/bin/docker-php-ext-install zip 

# Enable Apache mod_rewrite
RUN a2enmod rewrite && a2enmod headers && a2enmod ssl

WORKDIR /var/www/html
USER www-data

CMD ["apachectl", "-D", "FOREGROUND"]