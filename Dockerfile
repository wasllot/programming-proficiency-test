FROM alpine:latest

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl

RUN apk add --no-cache \
  nodejs \
  npm \
  php8 \
  php8-common \
  php8-opcache \
  php8-zip \
  php8-phar \
  php8-iconv \
  php8-cli \
  php8-curl \
  php8-openssl \
  php8-mbstring \
  php8-tokenizer \
  php8-fileinfo \
  php8-json \
  php8-xml \
  php8-xmlwriter \
  php8-simplexml \
  php8-tokenizer

RUN ln -s /usr/bin/php8 /usr/bin/php

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php