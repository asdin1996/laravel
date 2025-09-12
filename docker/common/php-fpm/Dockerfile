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
# Copiar script de entrypoint
# ----------------------------
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# ----------------------------
# Exponer puerto de PHP-FPM
# ----------------------------
EXPOSE 9000

# ----------------------------
# Comando por defecto
# ----------------------------
ENTRYPOINT ["entrypoint.sh"]
