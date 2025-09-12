#!/bin/sh
# Ajustar permisos
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Ejecutar cache solo si artisan existe
if [ -f /var/www/artisan ]; then
    php /var/www/artisan config:cache
    php /var/www/artisan route:cache
    php /var/www/artisan view:cache
fi

# Mantener el contenedor corriendo
php-fpm
