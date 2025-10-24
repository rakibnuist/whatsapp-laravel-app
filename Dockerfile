# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath zip \
    && docker-php-ext-enable opcache

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Sodium extension
RUN docker-php-ext-install sodium

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-interaction --ignore-platform-reqs

# Copy application code
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configure Apache
RUN a2enmod rewrite
COPY .htaccess /var/www/html/.htaccess

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
