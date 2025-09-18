#!/bin/sh
set -e

# ---------------------------
# Set permissions
# ---------------------------
# Ensure the www-data user owns the application files
chown -R www-data:www-data /var/www

# Ensure storage and bootstrap/cache are writable
chmod -R 775 /var/www/storage /var/www/bootstrap/cache || true

# ---------------------------
# Run Laravel cache commands if artisan exists
# ---------------------------
if [ -f /var/www/artisan ]; then
    cd /var/www

    echo "Clearing caches..."
    php artisan config:clear || true
    php artisan cache:clear || true
    php artisan view:clear || true
    php artisan route:clear || true

    echo "Rebuilding caches..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# ---------------------------
# Start PHP-FPM in the foreground
# ---------------------------
exec php-fpm
