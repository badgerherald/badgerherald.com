FROM nginx:latest

WORKDIR /usr/bin/

COPY apphost.conf /etc/nginx/nginx.conf
COPY provision-ssl.sh /usr/src/provision-ssl.sh

RUN chmod +x /usr/src/provision-ssl.sh

CMD /usr/src/provision-ssl.sh $SITE_URL \
    && nginx -g "daemon off;"