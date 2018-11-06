FROM alpine

RUN apk add curl

RUN apk add \
    g++ \
    make \
    autoconf \
    gdb \
    readline-dev

### Build PHP ###

ARG php_ver=7.1.22

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

ARG lua_ver=5.3.5

WORKDIR /lua

RUN curl -Ss https://www.lua.org/ftp/lua-${lua_ver}.tar.gz > lua.tar.gz

RUN tar -xf lua.tar.gz

WORKDIR /lua/lua-${lua_ver}

RUN apk add ncurses-dev

WORKDIR /lua/lua-${lua_ver}/src

# Manually run the src make file as struggling to control MYCFLAGS value.
RUN make all MYCFLAGS="-DLUA_USE_LINUX -fPIC" MYLIBS="-Wl,-E -ldl -lreadline -lhistory -lncurses"

WORKDIR /lua/lua-${lua_ver}

RUN make test

RUN make local INSTALL_TOP=/lua/lua-${lua_ver}/install

### Build PHP LUA extension ###

COPY ./ /src

WORKDIR /src

RUN phpize

RUN ./configure --with-lua=/lua/lua-${lua_ver}/install

RUN make

RUN make install

RUN echo "extension=lua.so" > /usr/local/lib/php.ini

CMD php -m