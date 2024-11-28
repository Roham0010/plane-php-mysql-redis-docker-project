# Use official PHP CLI image
FROM php:8.2-cli

# Install necessary dependencies and Redis extension
RUN apt-get update && apt-get install -y \
	libpq-dev \
	libzip-dev \
	zip \
	unzip \
	&& docker-php-ext-install pdo pdo_mysql \
	&& pecl install redis \
	&& docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install application dependencies
RUN composer install

# Expose port (only necessary for web servers like nginx, php-fpm)
EXPOSE 9000

# Default command (run php cli commands by default)
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
