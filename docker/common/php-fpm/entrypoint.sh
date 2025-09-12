#!/bin/sh
set -e

# Ajustar permisos
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache || true

# Ejecutar cache solo si artisan existe
if [ -f /var/www/artisan ]; then
    cd /var/www

    echo "Limpiando caches..."
    php artisan config:clear || true
    php artisan cache:clear || true
    php artisan view:clear || true
    php artisan route:clear || true

    echo "Regenerando caches..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Arrancar php-fpm en foreground
exec php-fpm
