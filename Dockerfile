FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    pkg-config libssl-dev nginx

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Working dir
WORKDIR /var/www

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel cache optimize
RUN php artisan config:clear && php artisan cache:clear

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Copy nginx config
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

CMD service nginx start && php-fpm