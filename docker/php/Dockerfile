FROM php:5.6-fpm
MAINTAINER Victor Diditskiy <victor.diditskiy@yandex.ru>

RUN apt-get update -y && \
    apt-get upgrade -y

RUN apt-get install -y libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libssl-dev \
        wget \
    && docker-php-ext-install -j$(nproc) iconv mcrypt mbstring \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) bcmath

RUN pecl install mongo \
    && echo "extension=mongo.so" > /usr/local/etc/php/conf.d/ext-mongo.ini

RUN pecl install -o -f redis xdebug \
    && rm -rf /tmp/pear \
    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
    && echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20131226/xdebug.so" > /usr/local/etc/php/conf.d/ext-xdebug.ini

RUN wget https://getcomposer.org/installer \
    && php installer --install-dir=/usr/local/bin --filename=composer

COPY ./php.ini /usr/local/etc/php/
#COPY . /code

WORKDIR /code

#RUN composer install