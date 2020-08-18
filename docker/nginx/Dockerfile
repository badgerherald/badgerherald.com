FROM nginx:latest

WORKDIR /usr/bin/

COPY badgerherald.com.conf /etc/nginx/nginx.conf
COPY provision-ssl.sh /usr/src/provision-ssl.sh

RUN chmod +x /usr/src/provision-ssl.sh

CMD /usr/src/provision-ssl.sh badgerherald.com \
&& nginx -g "daemon off;"