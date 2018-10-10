FROM php:7.1-alpine

RUN apk add \
    autoconf \
    g++ \
    make \
    lua-dev

COPY ./ /src

WORKDIR /src

RUN phpize

RUN ./configure

RUN make

RUN make install

RUN echo "extension=lua.so" > /usr/local/etc/php/php.ini

CMD php docker/test.php
