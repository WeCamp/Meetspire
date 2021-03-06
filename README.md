Meetspire
=========

Based on PHP, ZF2, bootstrap.

Requirements
-------------
This project was developed using:
* Ansible 1.7.1
* Vagrant 1.6.3
* Node 0.10.24

Installation
------------
To install this project please run:
```sh
vagrant up
php composer.phar install
npm install
grunt build
grunt watch
vendor/bin/doctrine-module orm:schema-tool:update --force
```

The project uses less to compile stylesheets. There are two ways to compile the css code from less:
* `grunt build` builds the css one time
* `grunt watch` watches for filechanges in assets/less and builds the css on a filechange

Tests
------------
Codeception is used for acceptance testing. To run Codeception, make sure you have installed the dev dependencies
through composer and run:
```sh
./vendor/bin/codecept run
```