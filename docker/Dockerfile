FROM alpine

RUN apk add curl

WORKDIR /php

RUN curl -Ss http://uk1.php.net/distributions/php-7.1.22.tar.bz2 > php-7.1.22.tar.bz2

RUN tar -xf php-7.1.22.tar.bz2

RUN apk add g++ make autoconf

WORKDIR /php/php-7.1.22

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

# TODO: make test?

RUN make install

RUN echo "extension=lua.so" > /usr/local/lib/php.ini

CMD php docker/test.php