FROM php:7.3-cli

RUN apt-get -qq update && apt-get -qq install libxml++2.6-dev > /dev/null

RUN docker-php-ext-install soap mbstring
RUN docker-php-ext-enable mbstring
