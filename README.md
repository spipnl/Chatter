Chatter
=======

Example Chat Application made with Zend Framework 2 and Doctrine 2 running in Docker.

Requirements
------------
* [Composer](https://getcomposer.org/)
* [Docker Toolbox](https://www.docker.com/docker-toolbox)

Installation
------------

###Docker

Download the [Docker Toolbox](https://www.docker.com/docker-toolbox).
After installing, run the Docker Quickstart Terminal and navigate to the project folder and run:

```
docker-compose build
```

This will use the `Dockerfile` in the `docker` folder and build the image used for running web server.

Next run:

```
docker-compose up -d
```

This will create a container based on the `docker-compose.yml` configuration and run it as a daemon.

###Project

Copy (or rename) `config/autoload/local.php.dist` to `config/autoload/local.php`.

Use composer to install the dependencies:
 
```php
php composer.phar install
```

Now it's time to run the Doctrine migrations:

```php
php public/index.php migrations:migrate -n
```

This will generate a SQLite database with all the necessary tables and data.

That's it! Now go to your web browser and navigate to:

```
http://chatter.dev:8001/
```
