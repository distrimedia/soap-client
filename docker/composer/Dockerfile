FROM php:7.3-cli

RUN apt-get -qq update && apt-get install -y \
        libxml++2.6-dev \
        libzip-dev \
        zip

RUN DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
     git \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install soap zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
