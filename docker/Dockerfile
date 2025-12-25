# =============================================================================
# Base stage: common dependencies and PHP extensions
# =============================================================================
FROM php:8.4-fpm-alpine AS base

ARG UID=1000
ARG GID=1000

# Runtime dependencies (kept in final image)
RUN apk add --no-cache \
    bash \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    icu-libs \
    oniguruma \
    sqlite-libs \
    libpq

# Build dependencies (removed after compilation)
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    sqlite-dev \
    postgresql-dev \
    linux-headers \
    # Configure and install PHP extensions
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_sqlite \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache \
    # Install Redis
    && pecl install redis \
    && docker-php-ext-enable redis \
    # Cleanup
    && apk del .build-deps \
    && rm -rf /tmp/pear

# Create user
RUN addgroup -g ${GID} laravel \
    && adduser -u ${UID} -G laravel -s /bin/sh -D laravel

# Common PHP-FPM config
COPY --chmod=644 docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html

# =============================================================================
# Development target
# =============================================================================
FROM base AS dev

# Install dev tools and Xdebug
RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    $PHPIZE_DEPS \
    linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /tmp/pear

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Dev PHP config
COPY docker/php/dev/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Entrypoint
COPY --chmod=755 docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Create directories
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache database \
    && chown -R laravel:laravel /var/www/html

USER laravel

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

# =============================================================================
# Production target
# =============================================================================
FROM base AS production

# Only essential runtime tools
RUN apk add --no-cache curl

# Install Composer (for dependency install during build)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Production PHP config
COPY docker/php/production/php.ini /usr/local/etc/php/conf.d/custom.ini

# Create log directory
RUN mkdir -p /var/log/php && chown laravel:laravel /var/log/php

# Entrypoint
COPY --chmod=755 docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Copy application files
COPY --chown=laravel:laravel . .

# Create directories
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache database \
    && chown -R laravel:laravel storage bootstrap/cache database

USER laravel

# Install production dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-cache || true \
    && rm -rf ~/.composer/cache

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
