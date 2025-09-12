#!/bin/sh
set -e

# Ajustar permisos
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Ejecutar Artisan caches solo si existe .env
if [ -f /var/www/.env ]; then
    echo "Caching Laravel config, routes, views..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Ejecutar PHP-FPM
exec php-fpm
