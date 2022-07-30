FROM wordpress:5.9.1-php7.4-fpm

# 1/ Install programs
RUN pecl install redis && docker-php-ext-enable redis
RUN apt-get update && apt-get -y install cron

# 2/ Install scripts
ADD docker-entrypoint.sh /usr/local/bin/local-docker-entrypoint.sh
RUN chmod 0644 /usr/local/bin/local-docker-entrypoint.sh

# 3/ Install crontab
RUN crontab -u www-data -l | { cat; echo "*/5 * * * * /usr/local/bin/php -q /var/www/html/wp-cron.php > /tmp/cron"; } | crontab -u www-data -

CMD bash /usr/local/bin/local-docker-entrypoint.sh && bash /usr/local/bin/docker-entrypoint.sh php-fpm