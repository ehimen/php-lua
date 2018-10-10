# PHP LUA Extension fork

## To build extension

Provided is a docker file which will compile & install the LUA extension for PHP 7.1.

To build:

```bash
$ docker build -t php-lua -f docker/Dockerfile .
```

To run:

```bash
$ docker run php-lua
```

By default, this image run a test script that uses LUA from inside PHP.
