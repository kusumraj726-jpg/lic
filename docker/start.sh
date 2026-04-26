#!/bin/sh

# Ensure storage and cache directories are writable by the web server
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start PHP-FPM in the background
php-fpm -D

# Create storage symlink
php artisan storage:link --force

# Run migrations
php artisan migrate --force

# Start Nginx in the foreground
nginx -g "daemon off;"
