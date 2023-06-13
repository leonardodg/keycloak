FROM php:7.4-apache

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

COPY ./docker/php/ /usr/local/etc/php/
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update -y && apt-get upgrade -y \
     && apt-get install -y curl libzip-dev zip unzip nano \
     &&  /usr/local/bin/docker-php-ext-install zip 

RUN chown -R www-data. /var/www/html/ && chmod -R 777 /var/www/html/
VOLUME /var/www/html

# # Install Composer PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite && a2enmod headers && a2enmod ssl

CMD ["apachectl", "-D", "FOREGROUND"]