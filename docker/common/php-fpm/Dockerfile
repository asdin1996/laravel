# Use official PHP 8.2 FPM image as base
FROM php:8.2-fpm

# ---------------------------
# Install necessary PHP extensions and system packages
# ---------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ---------------------------
# Install Composer
# ---------------------------
# Copy composer from the latest official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ---------------------------
# Set working directory inside container
# ---------------------------
WORKDIR /var/www

# ---------------------------
# Copy custom entrypoint script
# ---------------------------
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# ---------------------------
# Set entrypoint
# ---------------------------
ENTRYPOINT ["entrypoint.sh"]
