FROM node:12
WORKDIR /usr/src/
COPY package*.json tsconfig.json stencil.config.ts ./
COPY src/ ./src/
RUN npm install && npm run build
RUN ls 
RUN ls /usr/src/server/wp-content/themes/
# If you are building your code for production
# RUN npm ci --only=production

FROM wordpress:5-php7.4-fpm
RUN ls /usr/src/wordpress/
COPY --from=0 /usr/src/server/wp-content/themes/ /usr/src/wordpress/wp-content/themes/
RUN ls -lah /usr/src/wordpress/wp-content/themes/
RUN chown -R www-data:www-data /usr/src/wordpress/*

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev
RUN pecl install memcache
RUN echo "extension = memcache.so" >>  /etc/php.ini
RUN touch /usr/local/etc/php/conf.d/memcache-ext.ini \
    && echo "extension = memcache.so" >> /usr/local/etc/php/conf.d/memcache-ext.ini

RUN touch /usr/local/bin/apache2-custom.sh \
&& echo 'hi' \
&& echo "\
touch /usr/src/wordpress/wp-config-2.php\
echo 'stuff' >> /usr/src/wordpress/wp-config-2.php\
\
exec 'apache2-foreground'\
" >> /usr/local/bin/apache2-custom.sh

RUN chmod +x /usr/local/bin/apache2-custom.sh

CMD apache2-custom.sh