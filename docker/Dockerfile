FROM alpine

RUN apk add curl

RUN apk add \
    g++ \
    make \
    autoconf \
    gdb \
    lua-dev

ENV php_ver 7.1.22

WORKDIR /php

RUN curl -Ss http://uk1.php.net/distributions/php-${php_ver}.tar.bz2 > php.tar.bz2

RUN tar -xf php.tar.bz2

WORKDIR /php/php-${php_ver}

RUN ./configure \
    --disable-libxml \
    --disable-dom \
    --disable-simplexml \
    --disable-xmlwriter \
    --disable-xmlreader \
    --disable-xml \
    --without-pear \
    --enable-debug

RUN make

RUN make install

COPY ./ /src

WORKDIR /src

RUN phpize

RUN ./configure

RUN make

# TODO: make test?

RUN make install

RUN echo "extension=lua.so" > /usr/local/lib/php.ini

CMD php -m