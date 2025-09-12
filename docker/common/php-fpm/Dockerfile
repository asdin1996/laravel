# ----------------------------
# Dockerfile para Laravel PHP-FPM
# ----------------------------

# Imagen base
FROM php:8.2-fpm

# ----------------------------
# Instalación de dependencias del sistema y extensiones PHP
# ----------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ----------------------------
# Instalar Composer
# ----------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ----------------------------
# Crear directorio de trabajo
# ----------------------------
WORKDIR /var/www

# ----------------------------
# Copiar el proyecto al contenedor
# ----------------------------
COPY . /var/www

# ----------------------------
# Copiar .env de ejemplo si el .env real no está versionado
# ----------------------------
COPY .env.example /var/www/.env

# ----------------------------
# Ajustar permisos para PHP-FPM
# ----------------------------
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# ----------------------------
# Cache de Laravel (opcional, solo si .env existe)
# ----------------------------
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache || echo "No .env, skipping cache"

# ----------------------------
# Exponer puerto de PHP-FPM
# ----------------------------
EXPOSE 9000

# ----------------------------
# Comando por defecto
# ----------------------------
CMD ["php-fpm"]
