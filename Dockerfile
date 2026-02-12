# Start from PHP 8.2 FPM image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev curl npm nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Create dummy SQLite database to prevent Laravel errors
RUN mkdir -p database && touch database/database.sqlite

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install
RUN npm run build

# Expose port
EXPOSE 8000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
