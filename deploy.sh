#!/bin/sh

# maintenance mode
php artisan down

# update source code
git pull

# update PHP dependencies
export COMPOSER_HOME='/tmp/composer'
composer install --no-interaction --no-dev --prefer-dist

# clear cache
php artisan cache:clear

# clear config cache
php artisan config:clear

# cache config
php artisan config:cache

# restart queues
php artisan -v queue:restart

# update database
php artisan migrate --force

# stop maintenance mode
php artisan up
