#!/bin/bash

# 1/ dump ENV variables into cron environment
printenv > /etc/environment

# 1/ start cron service
service cron start