#!/bin/sh

# update application cache
php artisan optimize
php artisan migrate

# start the application
php-fpm -D &&  nginx -g "daemon off;"