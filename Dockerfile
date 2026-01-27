FROM php:8.2-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl libzip-dev \
    libpq-dev \
    build-essential \
    gawk \
    nano \
    less \
    nodejs npm \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions
RUN docker-php-ext-install \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    pdo pdo_pgsql pgsql

# 3. Apache Config
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Copy project
COPY . /var/www/html

# 5. Set working directory
WORKDIR /var/www/html

# 6. Fix ownership BEFORE installing dependencies
RUN chown -R www-data:www-data /var/www/html

# 7. Install Composer as root, then switch user
USER www-data

# 8. Install dependencies as www-data (fixes permission issues)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# 9. Install npm dependencies
RUN npm install --no-audit --no-fund

# 10. Build assets
RUN npm run build

# 11. Switch back to root for final setup
USER root

# 12. Create entrypoint script
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# 13. Final permissions
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

ENTRYPOINT ["entrypoint.sh"]
