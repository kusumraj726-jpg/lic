#!/bin/sh

# Start PHP-FPM in the background
php-fpm -D

# Run migrations (optional, can be done manually or via deployment hooks)
# php artisan migrate --force

# Start Nginx in the foreground
nginx -g "daemon off;"
