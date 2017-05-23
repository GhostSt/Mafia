FROM rabbitmq
MAINTAINER Victor Diditskiy <victor.diditskiy@yandex.ru>

COPY rabbitmqadmin /usr/local/bin

RUN chmod +x /usr/local/bin/rabbitmqadmin

RUN apt-get update
RUN apt-get -y install software-properties-common

RUN apt-get install python3 \
    && sh -c 'rabbitmqadmin --bash-completion > /etc/bash_completion.d/rabbitmqadmin'

RUN rabbitmq-plugins enable rabbitmq_management \
    && rabbitmq-plugins enable rabbitmq_tracing