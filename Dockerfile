FROM php:8.2-apache

# System deps
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev \
    zip unzip git curl libzip-dev

# PHP extensions (PostgreSQL, NOT MySQL)
RUN docker-php-ext-install mbstring exif pcntl bcmath gd zip \
    && docker-php-ext-install pdo_pgsql pgsql

# Apache config
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy app
COPY . /var/www/html

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN mkdir -p storage/framework/{sessions,views,cache/data} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Start Apache only
CMD apache2-foreground
