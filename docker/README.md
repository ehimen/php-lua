# PHP LUA Extension fork

## To build extension

Provided is a docker file which will compile & install the LUA extension for PHP 7.1.

To build:

```sh
$ docker build -t php-lua -f docker/Dockerfile --build-arg php_ver=7.1.22 --build-arg lua_ver=5.3.5 .
```

To run:

```sh
$ docker run php-lua
```

To run with GDB for debugging extension code:

```sh
$ docker run -it -v `pwd`/docker:/src/docker --cap-add=SYS_PTRACE --security-opt seccomp=unconfined php-lua gdb php
```

Note this also mounts the docker/ directory, so PHP files can be edited in there, and then run from with gdb, e.g.

```
(gdb) run docker/test.php
```
