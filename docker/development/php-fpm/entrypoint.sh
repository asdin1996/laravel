#!/bin/bash
# Ajustar permisos
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Mantener el contenedor corriendo
php-fpm
