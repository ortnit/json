FROM ubuntu:20.04
ARG DEBIAN_FRONTEND=noninteractive
ENV TZ="Europe/Berlin"
RUN apt-get update && apt-get -y --no-install-recommends install \
    git curl wget openssh-client ca-certificates unzip \
    && apt-get upgrade -y

RUN apt-get install software-properties-common -y \
    && add-apt-repository ppa:ondrej/php -y \
    && apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y php8.1-cli php8.1-dom php8.1-mbstring php8.1-xml php8.1-xmlwriter php8.1-xdebug php8.1-json

RUN rm -rf /var/lib/apt/lists/*

# composer 2 required, hence no distribution package (ubuntu:focal composer package at version 1.10)
RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"


RUN mkdir -pv /app

WORKDIR /app