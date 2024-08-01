FROM php:8.3.9-fpm-alpine as base

RUN set -xe \
    && apk add --no-cache --virtual .build-deps curl g++ make autoconf php-pear;

RUN apk --no-cache --update add \
    git \
    zlib-dev \
    icu-dev \
    libzip-dev \
    libmcrypt-dev \
    coreutils \
    postgresql-dev \
    openssh \

RUN docker-php-ext-install \
    zip \
    pdo \
    pdo_pgsql \
    intl \
    opcache

# Copy composer from official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set up user permissions
RUN apk --no-cache add shadow && \
    usermod -u 1000 www-data

# Create application directory and set permissions
RUN mkdir -p /var/www/app && chown www-data:www-data /var/www/app

# Copy PHP configuration overrides
COPY ./docker/php-fpm/php-ini-overrides.ini "$PHP_INI_DIR/conf.d/99-php-ini-overrides.ini"
COPY ./docker/php-fpm/opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"

# Set working directory and switch to www-data user
USER www-data
WORKDIR /var/www/app

# Expose port 9000
EXPOSE 9000

# Command to run PHP-FPM
CMD php-fpm

# Development stage
FROM base as dev

# Production stage
FROM base as prod

# Copy application code
COPY --chown=www-data:www-data ./app /var/www/app

# Command to run PHP-FPM
CMD php-fpm