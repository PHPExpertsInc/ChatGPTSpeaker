#!/bin/bash

clear
rm -rf composer.lock vendor
PHP_VERSION=7.4 composer install

time for PHPV in 7.4 8.0 8.1 8.2 8.3; do 
    echo "PHP Version: $PHPV"
    PHP_VERSION=$PHPV composer update
    PHP_VERSION=$PHPV phpunit
    read
done

