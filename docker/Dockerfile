FROM php:5.6-apache
COPY php.ini /usr/local/etc/php/
COPY apache-config.conf /etc/apache2/sites-enabled
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
