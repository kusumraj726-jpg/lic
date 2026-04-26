#!/bin/sh

# Start PHP-FPM in the background
php-fpm -D

# Create storage symlink and run migrations
# We do this before the final chown in case they create root-owned files
php artisan storage:link --force
php artisan migrate --force

# Final permission fix: Ensure EVERYTHING in storage/cache is owned by www-data
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start Nginx in the foreground
nginx -g "daemon off;"
