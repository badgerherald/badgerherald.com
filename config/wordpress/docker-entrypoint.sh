#!/bin/bash

# 1/ configure new-relic php agent
sed -i -e "s/REPLACE_WITH_REAL_KEY/${NRIA_LICENSE_KEY}/" \
    -e "s/newrelic.appname.*/newrelic.appname=\"${COMPOSE-PROJECT-NAME}-wordpress/app\"/" \
    $(php -r "echo(PHP_CONFIG_FILE_SCAN_DIR);")/newrelic.ini

# 2/ dump ENV variables into cron environment
printenv > /etc/environment

# 3/ start cron service
service cron start