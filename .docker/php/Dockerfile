FROM php:8.3-cli

ARG uid=1000
ARG user="app"

COPY "./*.ini" "/usr/local/etc/php/conf.d/"

RUN apt update \
&& apt upgrade -y \
&& apt install -y \
    wget \
    zip \
    git \
    sqlite3 \
    libicu-dev \
&& docker-php-ext-install \
    pdo_mysql \
    intl \
&& pecl install \
    xdebug \
&& docker-php-ext-enable \
    xdebug \
&& wget -O "/usr/local/bin/composer" "https://getcomposer.org/composer-stable.phar" \
&& chmod -R 755 "/usr/local/bin" \
&& useradd --create-home --user-group --uid=$uid $user
