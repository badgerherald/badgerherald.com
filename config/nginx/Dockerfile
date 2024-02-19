FROM nginx:latest

WORKDIR /usr/bin/

COPY apphost.conf /etc/nginx/nginx.conf

COPY provision-ssl.sh /usr/src/provision-ssl.sh
COPY provision-phpmyadmin.sh /usr/src/provision-phpmyadmin.sh
RUN chmod +x /usr/src/provision-ssl.sh
RUN chmod +x /usr/src/provision-phpmyadmin.sh

CMD /usr/src/provision-ssl.sh $SITE_URL \
    && /usr/src/provision-phpmyadmin.sh $NGINX_PMA_PASSWORD \
    && nginx -g "daemon off;"