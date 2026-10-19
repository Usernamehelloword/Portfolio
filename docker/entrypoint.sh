#!/bin/sh
set -e

# Configure port for Nginx (Render assigns dynamic PORT, default to 10000)
PORT="${PORT:-10000}"
echo "==> Configuring Nginx on port ${PORT}..."
sed -i "s/PORT_PLACEHOLDER/${PORT}/g" /etc/nginx/http.d/default.conf

# Setup SQLite database if SQLite connection is used
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    DB_PATH="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    echo "==> Checking SQLite database at ${DB_PATH}..."
    mkdir -p "$(dirname "$DB_PATH")"
    if [ ! -f "$DB_PATH" ]; then
        echo "==> Creating empty SQLite database file..."
        touch "$DB_PATH"
    fi
    chown -R www-data:www-data /var/www/html/database
    chmod -R 775 /var/www/html/database
    chmod 664 "$DB_PATH"
fi

# Ensure storage, bootstrap/cache, and supervisor log directories
echo "==> Setting directory permissions..."
mkdir -p /var/www/html/storage/framework/cache \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache \
         /var/log/supervisor

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create storage symbolic link if not already created
if [ ! -L /var/www/html/public/storage ]; then
    echo "==> Creating storage symlink..."
    php artisan storage:link || true
fi

# Cache configuration, routes, and views in production
if [ "${APP_ENV:-production}" = "production" ]; then
    echo "==> Caching Laravel configuration and routes..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Run database migrations
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "==> Running database migrations..."
    php artisan migrate --force || true
fi

# Run database seeders if requested
if [ "${RUN_SEEDER:-false}" = "true" ]; then
    echo "==> Running database seeders..."
    php artisan db:seed --force || true
fi

echo "==> Application ready. Starting Supervisor..."
exec "$@"
