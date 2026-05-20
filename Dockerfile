FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM dunglas/frankenphp:1.3-php8.3-alpine

# Install PHP extensions
RUN install-php-extensions \
    pcntl \
    bcmath \
    gd \
    intl \
    zip \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    redis

# Set working directory
WORKDIR /app

# Copy application files
COPY . .
COPY --from=assets /app/public/build ./public/build

# Install composer dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV FRANKENPHP_CONFIG="import /app/Caddyfile"

# Expose ports
EXPOSE 80 443 8080

ENTRYPOINT ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=80"]
