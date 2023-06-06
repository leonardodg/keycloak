FROM php:7.4-apache
RUN apt-get update -y && apt-get upgrade -y

RUN chown -R www-data. /var/www/html/ && chmod -R 777 /var/www/html/
VOLUME /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite && a2enmod headers && a2enmod ssl

CMD ["apachectl", "-D", "FOREGROUND"]