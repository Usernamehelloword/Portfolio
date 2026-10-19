# ==========================================
# Stage 1: Frontend Asset Compilation (Vite)
# ==========================================
FROM node:20-alpine AS node_builder

WORKDIR /app

# Copy dependency specifications and install packages
COPY package*.json ./
RUN npm ci || npm install

# Copy application files and build production assets
COPY . .
RUN npm run build

# ==========================================
# Stage 2: Production PHP-FPM + Nginx Container
# ==========================================
FROM php:8.2-fpm-alpine

# Install system dependencies and build libraries
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    unzip \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev \
    sqlite-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        mbstring \
        zip \
        exif \
        pcntl \
        bcmath \
        intl \
        opcache \
        gd \
    && rm -rf /var/cache/apk/*

# Copy Composer binary from official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy server configuration files
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Make entrypoint script executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy application source code
COPY . .

# Copy compiled frontend assets from Node build stage
COPY --from=node_builder /app/public/build ./public/build

# Install PHP production dependencies with Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set up proper directory permissions for Laravel
RUN mkdir -p \
        /var/www/html/storage/framework/cache \
        /var/www/html/storage/framework/sessions \
        /var/www/html/storage/framework/views \
        /var/www/html/storage/logs \
        /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Render assigns a dynamic port (default 10000)
EXPOSE 10000

# Set entrypoint and default command
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
