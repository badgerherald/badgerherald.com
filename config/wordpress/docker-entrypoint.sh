#!/bin/bash

# 1/ configure new-relic php agent
sed -i -e "s/REPLACE_WITH_REAL_KEY/$NRIA_LICENSE_KEY/" \
    -e "s/newrelic.appname.*/newrelic.appname=\"$NRIA_APP_NAME\"/" \
    $(php -r "echo(PHP_CONFIG_FILE_SCAN_DIR);")/newrelic.ini

# 2/ dump ENV variables into cron environment
printenv > /etc/environment

# 3/ create php-fpm.conf
cat > /usr/local/etc/php-fpm.d/zzz-my-extra.conf <<ENDPHPFPMCONF
[www]
pm = static
pm.max_children = $PHP_FPM_MAX_CHILDREN
pm.max_requests = 500
ENDPHPFPMCONF

# 4/ create php.ini
cat > /usr/local/etc/php/conf.d/extra.ini <<ENDPHPINI
file_uploads = On
memory_limit = $PHP_MEMORY_LIMIT
upload_max_filesize = 6M
post_max_size = 64M
max_execution_time = 600

opcache.max_accelerated_files=20000
opcache.memory_consumption=$PHP_OPCACHE_MEMORY_LIMIT
ENDPHPINI

# 5/ start cron service
service cron start