#!/bin/sh
set -e

# Create SQLite database directory and file if they don't exist
if [ ! -d /var/www/html/database ]; then
    mkdir -p /var/www/html/database
fi

if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    echo "Created SQLite database"
fi

# Run Laravel-specific commands only if artisan exists
if [ -f /var/www/html/artisan ]; then
    # Generate app key if not set
    if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
        php artisan key:generate --force 2>/dev/null || true
    fi

    # Run migrations
    php artisan migrate --force 2>/dev/null || true

    # Cache configuration in production
    if [ "$APP_ENV" = "production" ]; then
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache
    fi
fi

exec "$@"
