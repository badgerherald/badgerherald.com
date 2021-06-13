#!/bin/bash
#
# Shell script for generating self-signed cert for Vagrant
#

FILE=/etc/ssl/private/localhost.key

if [ -f "$FILE" ]; then
    echo "$FILE exists."
    exit
fi

cd tmp/

DOMAIN=${DOMAIN}

if [ -z "$DOMAIN" ]; then
  echo "Usage: $(basename $0) <domain>"
  exit 11
fi

fail_if_error() {
  [ $1 != 0 ] && {
    unset PASSPHRASE
    exit 10
  }
}

# Generate a passphrase
export PASSPHRASE=$(head -c 500 /dev/urandom | tr -dc a-z0-9A-Z | head -c 128; echo)

# Certificate details; replace items in angle brackets with your own info
subj="
C=US
ST=WI
O=localhost
localityName=Madison
commonName=$DOMAIN
organizationalUnitName=The Badger Herald
emailAddress=wjh@wjh.dev
"

# Generate the server private key
openssl genrsa -des3 -out $DOMAIN.key -passout env:PASSPHRASE 2048
fail_if_error $?

# Generate the CSR
openssl req \
    -new \
    -batch \
    -subj "$(echo -n "$subj" | tr "\n" "/")" \
    -key $DOMAIN.key \
    -out $DOMAIN.csr \
    -passin env:PASSPHRASE
    
# Strip the password so we don't have to type it every time we restart nginx
openssl rsa -in $DOMAIN.key -out $DOMAIN.key -passin env:PASSPHRASE

# Generate the cert (good for 10 years)
openssl x509 -req -days 3650 -in $DOMAIN.csr -signkey $DOMAIN.key -out $DOMAIN.crt

mv $DOMAIN.key /etc/ssl/private/localhost.key
mv $DOMAIN.crt /etc/ssl/certs/localhost.crt