

FROM ubuntu:20.04
RUN echo "Hello Hamed !"
RUN  apt-get -y update && apt-get  install -y curl

#RUN mkdir /usr/share/elasticsearch
#WORKDIR /usr/share/elasticsearch
#COPY elasticsearch.yml config/
#COPY elasticsearch.yml    /usr/share/elasticsearch/elasticsearch.yml
#COPY elasticsearch.yml  /etc/elasticsearch/elasticsearch.yml


COPY users.json /users.json
COPY user_posts.json /user_posts.json
COPY docker-entrypoint.sh /docker-entrypoint.sh
COPY docker-entrypoint.sh /run/docker-entrypoint.sh

RUN chmod +x /run/docker-entrypoint.sh
ENTRYPOINT ["/run/docker-entrypoint.sh"]

