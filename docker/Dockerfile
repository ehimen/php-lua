FROM alpine

RUN apk add curl

RUN apk add \
    g++ \
    make \
    autoconf \
    gdb \
    readline-dev

### Build PHP ###

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

### Build LUA ###

ENV lua_ver 5.3.5

WORKDIR /lua

RUN curl -Ss https://www.lua.org/ftp/lua-${lua_ver}.tar.gz > lua.tar.gz

RUN tar -xf lua.tar.gz

WORKDIR /lua/lua-${lua_ver}

# Compile with -fPIC to ensure PHP LUA extension can compile against this version of LUA.
RUN sed -i s/MYCFLAGS=/MYCFLAGS=-fPIC/ src/Makefile

RUN make linux test

RUN make local

### Build PHP LUA extension ###

COPY ./ /src

WORKDIR /src

RUN phpize

RUN ./configure --with-lua=/lua/lua-${lua_ver}/install

RUN make

RUN make install

RUN echo "extension=lua.so" > /usr/local/lib/php.ini

#RUN apk add valgrind

CMD php -m