#!/bin/bash

# 0/ re-permission media-kit
chown -R www-data:www-data /var/www/html/media-kit

# 1/ dump ENV variables into cron environment
printenv > /etc/environment

# 2/ start cron service
service cron start