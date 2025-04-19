FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel project files into the container
COPY . .

RUN cp .env.example .env

# Make and use entrypoint.sh
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions (optional but good)
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose port and run Laravel's built-in server
EXPOSE 8000
# Set the entrypoint
CMD ["/entrypoint.sh"]

