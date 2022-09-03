FROM nginx:latest

WORKDIR /usr/bin/
RUN apt-get update -y && apt-get -y install wget gnupg2

# 2/ Install new relic php agent
RUN echo 'deb http://apt.newrelic.com/debian/ newrelic non-free' | tee /etc/apt/sources.list.d/newrelic.list
RUN wget -O- https://download.newrelic.com/548C16BF.gpg | apt-key add -
RUN apt-get update -y && apt-get install newrelic-cli -y

COPY apphost.conf /etc/nginx/nginx.conf
COPY provision-ssl.sh /usr/src/provision-ssl.sh

RUN chmod +x /usr/src/provision-ssl.sh

CMD /usr/src/provision-ssl.sh $SITE_URL \
    && nginx -g "daemon off;"
