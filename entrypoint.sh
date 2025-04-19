#!/bin/sh

# Prepare Laravel
php artisan key:generate
php artisan config:cache
php artisan migrate --force
php artisan db:seed --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
