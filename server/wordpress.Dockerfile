FROM wordpress:5-php7.4-fpm

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev

RUN pecl install memcache
RUN echo "extension = memcache.so" >>  /etc/php.ini

RUN touch /usr/local/etc/php/conf.d/memcache-ext.ini \
    && echo "extension = memcache.so" >> /usr/local/etc/php/conf.d/memcache-ext.ini
