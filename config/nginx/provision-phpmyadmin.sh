#!/bin/bash
#
# Shell script for generating self-signed cert for Vagrant and updating .htpasswd for nginx
#

FILE=/etc/nginx/.htpasswd
USER="phpmyadmin"

# Check if .htpasswd exists and exit if it does
if [ -f "$FILE" ]; then
    echo "$FILE exists."
    exit 0
fi

NGINX_PMA_PASSWORD=$1

# Check if the NGINX_PMA_PASSWORD variable is set
if [ -z "${NGINX_PMA_PASSWORD}" ]; then
    echo "The NGINX_PMA_PASSWORD environment variable is not set."
    exit 1
fi

# Use openssl to generate the password entry
PASSWORD_HASH=$(openssl passwd -apr1 "${NGINX_PMA_PASSWORD}")

# Check for openssl command success
if [ $? -ne 0 ]; then
    echo "Failed to hash the password using openssl."
    exit 1
fi

# Append the user and hashed password to the .htpasswd file
echo "${USER}:${PASSWORD_HASH}" > "$FILE"

echo ".htpasswd has been updated with the user $USER."
