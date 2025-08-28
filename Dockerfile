# Build stage untuk assets
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Production stage
FROM php:8.3-apache

# Install sistem dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev libxml2-dev libpq-dev \
    libicu-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring xml gd intl exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure Apache
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
 && a2enmod rewrite \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy dependency files first for better layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies without scripts to avoid errors
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts

# Copy source code
COPY . /var/www/html

# Copy built assets from build stage
COPY --from=assets /app/public/build /var/www/html/public/build

# Direktori penting + permission dasar
RUN mkdir -p storage/app/public \
 && mkdir -p storage/logs \
 && mkdir -p storage/framework/cache \
 && mkdir -p storage/framework/sessions \
 && mkdir -p storage/framework/views \
 && mkdir -p bootstrap/cache \
 && chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# PHP upload & session tuning
RUN printf "upload_max_filesize=50M\npost_max_size=50M\nmax_execution_time=300\nmax_input_time=300\nmemory_limit=256M\nsession.cookie_secure=0\nsession.cookie_httponly=1\nsession.cookie_samesite=Lax\n" > /usr/local/etc/php/conf.d/uploads.ini

# Entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh


ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
