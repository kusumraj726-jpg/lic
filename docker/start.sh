#!/bin/sh

# Start PHP-FPM in the background
php-fpm -D

# Create storage symlink
php artisan storage:link --force

# Run migrations
php artisan migrate --force

# Start Nginx in the foreground
nginx -g "daemon off;"
